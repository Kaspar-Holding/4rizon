<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb434c4a7f592281baf6137c942d68cbc
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb434c4a7f592281baf6137c942d68cbc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb434c4a7f592281baf6137c942d68cbc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
