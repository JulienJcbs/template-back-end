<?php

\Stripe\Stripe::setApiKey($stripe);

class Stripe
{
    static function createTicket($amount, $qts, $reservationId)
    {
        $intent = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Votre réservation',
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => $qts,
                ],
            ],
            'metadata' => [
                'order_id' => $reservationId,
            ],
            'mode' => 'payment',
            'success_url' => 'https://cameratavocale-dev.website/success',
            'cancel_url' => 'https://cameratavocale-dev.website/cancel',
        ]);
        return $intent->url;
    }

    static function webhook($pdo, $payload, $sigHeader, $wh)
    {
        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $wh
            );
        } catch (\UnexpectedValueException $e) {
            encodeError($e->getMessage());
            return false;
        }

        if ($event->type == 'payment_intent.succeeded') {
            $reservationId = $event->data->object->metadata->order_id;
            Event::updateToPayed($pdo, $reservationId);
            encodeSuccess(true);
            return true;
        }
    }
}
