<?php

class Event
{

    static function selectEvent($pdo, $eventId)
    {
        if (!verifyExisteRow($pdo, 'events', 'id', $eventId)) {
            encodeError('Cet évènement n\'existe pas.');
            return false;
        }

        $event = Event::getEventById($pdo, $eventId);

        if (timeIsPassed($event['date'])) {
            encodeError('Il est trop tard que pour réserver cet évènement.');
            return false;
        }

        $placesVip = Event::getPlaces($pdo, $eventId, 'vip');
        $placesRegular = Event::getPlaces($pdo, $eventId, 1, 'regular');

        if ($placesVip <= 0 && $placesRegular <= 0) {
            encodeError('Il n\'y a plus de places disponnibles pour cet évènement.');
            return false;
        }

        encodeSuccess(['eventId' => $eventId]);
        return true;
    }

    private static  function getEventById($pdo, $eventId)
    {
        $req = $pdo->prepare('SELECT * FROM events WHERE id = :id');
        $req->execute([
            'id' => $eventId,
        ]);

        return $req->fetch();
    }

    static function getEventByIdForAdmin($pdo, $adminId, $eventId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }
        if (!verifyExisteRow($pdo, 'events', 'id', $eventId)) {
            encodeError('Cet évènement n\'existe pas.');
            return false;
        }

        $event = Event::getEventById($pdo, $eventId);

        $placesRegular = Event::getPlaces($pdo, $eventId, 'regular');
        $placesVip = Event::getPlaces($pdo, $eventId, 'vip');

        $event['p_reg'] = $placesRegular;
        $event['p_vip'] = $placesVip;

        encodeSuccess($event);
        return true;
    }

    private static function getPlaces($pdo, $eventId, $type)
    {
        $event = Event::getEventById($pdo, $eventId);

        if ($type == 'vip') {
            return ($event['nb_persons_vip'] - Event::getReservations($pdo, $eventId, $type));
        }
        if ($type == 'regular') {
            return ($event['nb_persons_regular'] - Event::getReservations($pdo, $eventId, $type));
        }
        return false;
    }

    private static function getReservations($pdo, $eventId, $type)
    {
        $req = $pdo->prepare('SELECT nb_persons FROM event_reservations WHERE event_id = :eventId AND type = :type AND status = "payed";');
        $req->execute([
            'eventId' => $eventId,
            'type' => $type,
        ]);

        $count = 0;

        while ($row = $req->fetch()) {
            $count += $row['nb_persons'];
        }

        return $count;
    }

    static function getEvents($pdo)
    {
        $req = $pdo->prepare('SELECT id, event_name FROM events WHERE visible = 1');
        $req->execute();

        encodeSuccess($req->fetchAll());
        return true;
    }

    static function createEvent($pdo, $eventName, $date, $nbRegular, $nbVip, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }

        if (!verifyStrlen($eventName, 3, 255)) {
            encodeError('Longueur du nom invalide.');
            return false;
        }

        $id = generateRandomString();
        while (verifyExisteRow($pdo, 'events', 'id', $id)) {
            $id = generateRandomString();
        }

        $req = $pdo->prepare('INSERT INTO events (id, nb_persons_regular, visible, date, event_name, nb_persons_vip) VALUES (:id, :nbR, :visible, :date, :eventName, :nbV);');
        $req->execute([
            'id' => $id,
            'nbR' => $nbRegular,
            'visible' => false,
            'date' => $date,
            'eventName' => $eventName,
            'nbV' => $nbVip,
        ]);

        encodeSuccess(['eventId' => $id]);
        return true;
    }

    static function getEventByIdForFront($pdo, $eventId)
    {
        if (!verifyExisteRow($pdo, 'events', 'id', $eventId)) {
            encodeError('L\'évènement est introuvable.');
            return false;
        }

        $event = Event::getEventById($pdo, $eventId);

        encodeSuccess($event);
        return true;
    }

    static function updateToPayed($pdo, $reservationId)
    {
        $req = $pdo->prepare('UPDATE event_reservations SET status = "payed" WHERE id = :reservationId;');
        $req->execute([
            'reservationId' => $reservationId,
        ]);

        return true;
    }

    static function createReservation($pdo, $userId, $type, $event_id, $nbPersons)
    {
        if (!verifyExisteRow($pdo, 'users', 'id', $userId)) {
            encodeError('Une erreur est survenue');
            return false;
        }

        if ($type != 'vip' && $type != 'regular') {
            encodeError('type invalide');
            return false;
        }

        if (!verifyExisteRow($pdo, 'events', 'id', $event_id)) {
            encodeError('Evènement introuvable.');
            return false;
        }

        $places = Event::getPlaces($pdo, $event_id, $type);

        if ($places < $nbPersons) {
            encodeError('Il ne reste ne reste malheureusement plus assez de places pour votre demande (restant ' . $places . ').');
            return false;
        }

        if ($nbPersons <= 0) {
            encodeError('Nombre de participants invalide');
            return false;
        }

        $id = generateRandomString();
        $ref = generateRandomString(18);

        while (verifyExisteRow($pdo, 'event_reservations', 'id', $id)) {
            $id = generateRandomString();
        }

        $req = $pdo->prepare('INSERT INTO event_reservations (id, ref, user_id, type, event_id, nb_persons) VALUES (:id, :ref, :user_id, :type, :event_id, :nbPersons);');
        $req->execute([
            'id' => $id,
            'ref' => $ref,
            'user_id' => $userId,
            'type' => $type,
            'event_id' => $event_id,
            'nbPersons' => $nbPersons,
        ]);

        $event = Event::getEventById($pdo, $event_id);
        $prize = 0;
        if ($type == 'regular') {
            $prize = $event['reg_prize'] * 100;
        }
        if ($type == 'vip') {
            $prize = $event['vip_prize'] * 100;
        }

        $url = Stripe::createTicket($prize, $nbPersons, $id);

        if ($url) {
            encodeSuccess(['url' => $url]);
            return true;
        }
        return false;
    }

    public static function updateEventVisibility($pdo, $adminId, $eventId, $visibility)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès réfusé.');
            return false;
        }

        if (!verifyExisteRow($pdo, 'events', 'id', $eventId)) {
            encodeError('Cet évènement n\'existe pas.');
            return false;
        }

        $req = $pdo->prepare("UPDATE events SET visible = :visible WHERE id = :id");
        $req->execute([
            'id' => $eventId,
            'visible' => $visibility,
        ]);

        encodeSuccess(true);
        return true;
    }

    static function getEventsForAdmin($pdo, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès réfusé.');
            return false;
        }

        $req = $pdo->prepare('SELECT * FROM events');

        $req->execute();

        encodeSuccess($req->fetchAll());
        return true;
    }
}
