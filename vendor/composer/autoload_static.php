<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8c679d7c96b26ace49ddb666b86f4bfe
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
            0 => __DIR__ . '/../..' . '/clases/detalles',
            1 => __DIR__ . '/../..' . '/clases/clientes',
            2 => __DIR__ . '/../..' . '/clases',
            3 => __DIR__ . '/../..' . '/clases/db',
        ),
    );

    public static $prefixesPsr0 = array (
        'B' => 
        array (
            'Bramus' => 
            array (
                0 => __DIR__ . '/..' . '/bramus/router/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8c679d7c96b26ace49ddb666b86f4bfe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8c679d7c96b26ace49ddb666b86f4bfe::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit8c679d7c96b26ace49ddb666b86f4bfe::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit8c679d7c96b26ace49ddb666b86f4bfe::$classMap;

        }, null, ClassLoader::class);
    }
}
