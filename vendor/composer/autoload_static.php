<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdae564c9c4c73f38c14ef2d2a18b40b2
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'M' => 
        array (
            'Model\\' => 6,
            'MVC\\' => 4,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'MVC\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdae564c9c4c73f38c14ef2d2a18b40b2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdae564c9c4c73f38c14ef2d2a18b40b2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdae564c9c4c73f38c14ef2d2a18b40b2::$classMap;

        }, null, ClassLoader::class);
    }
}
