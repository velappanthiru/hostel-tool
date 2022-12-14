<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb00cb568f3d6b45901101ac896b0a98b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitb00cb568f3d6b45901101ac896b0a98b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb00cb568f3d6b45901101ac896b0a98b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb00cb568f3d6b45901101ac896b0a98b::$classMap;

        }, null, ClassLoader::class);
    }
}
