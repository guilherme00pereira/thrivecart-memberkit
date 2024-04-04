<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3c56f4806ea86e377003b4daa59f7cb8
{
    public static $files = array (
        '22b1a903ca64b2cc09e2e5223a2c8cd3' => __DIR__ . '/../..' . '/src/startup.php',
    );

    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'G28\\ThriveCartMemberKit\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'G28\\ThriveCartMemberKit\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3c56f4806ea86e377003b4daa59f7cb8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3c56f4806ea86e377003b4daa59f7cb8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3c56f4806ea86e377003b4daa59f7cb8::$classMap;

        }, null, ClassLoader::class);
    }
}
