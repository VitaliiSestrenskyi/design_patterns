<?
/**
 * Class Registry
 */
class Registry
{
    private static $instance;
    private $values = array();

    private function __construct() {}
    
    private function __wakeup() {}

    private function __clone() {}
   
    public static function getInstance()
    {
        if( ! isset(self::$instance) )
            self::$instance = new self();

        return self::$instance;
    }

    public function get( $key )
    {
        if( isset($this->values[$key]) )
            return $this->values[$key];

        return null;
    }

    public function set( $key, $value )
    {
        $this->values[$key] = $value;
    }
}


//realization
$registry = Registry::getInstance();
$registry->set('MainClass', new MainClass());
$registry->get('MainClass');
