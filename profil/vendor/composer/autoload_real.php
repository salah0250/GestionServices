<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitfcad8daf9fd78d166ffa36edf5d20a8c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitfcad8daf9fd78d166ffa36edf5d20a8c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitfcad8daf9fd78d166ffa36edf5d20a8c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitfcad8daf9fd78d166ffa36edf5d20a8c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
