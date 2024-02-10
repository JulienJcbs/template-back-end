<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7424eaa24a56023a8785bc7ed85b67fc
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7424eaa24a56023a8785bc7ed85b67fc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7424eaa24a56023a8785bc7ed85b67fc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7424eaa24a56023a8785bc7ed85b67fc::$classMap;

        }, null, ClassLoader::class);
    }
}
