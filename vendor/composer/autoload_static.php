<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit403882fb20d5dc6b820b89526ff5e451
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit403882fb20d5dc6b820b89526ff5e451::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit403882fb20d5dc6b820b89526ff5e451::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit403882fb20d5dc6b820b89526ff5e451::$classMap;

        }, null, ClassLoader::class);
    }
}
