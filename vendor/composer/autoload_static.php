<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita8433c4f335cc30d9641f266e48c6635
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Launch\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Launch\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita8433c4f335cc30d9641f266e48c6635::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita8433c4f335cc30d9641f266e48c6635::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
