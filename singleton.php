<?
/**
 * Class Singleton
 */
class Singleton
{
    private static $instance;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance()
    {
        if( ! isset(self::$instance) )
            self::$instance = new Singleton();

        return self::$instance;
    }
}


//realization
$singleton = Singleton::getInstance();

