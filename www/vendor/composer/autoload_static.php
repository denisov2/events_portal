<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitee3625b8ba1f29fae45d2b758750f724
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sendpulse\\RestApi\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sendpulse\\RestApi\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendpulse/rest-api/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitee3625b8ba1f29fae45d2b758750f724::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitee3625b8ba1f29fae45d2b758750f724::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
