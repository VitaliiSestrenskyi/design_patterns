<?
abstract class Command
{
    abstract public function execute( CommandContext $context );
}

class LoginCommand extends Command
{
    public function execute(CommandContext $context)
    {
        $user_obj = new User();
        $context->addParam( 'user', $user_obj );
        return true;
    }
}

class CommandContext
{
    private $params = array();
    private $error  = "";

    function __construct()
    {
        $this->params = $_REQUEST;
    }

    function addParam( $key, $val )
    {
        $this->params[$key] = $val;
    }

    function get ($key)
    {
        return $this->params[$key];
    }

    function setError( $error )
    {
        $this->error = $error;
    }

    function getError()
    {
        return $this->error;
    }
}

class CommandFactory
{
    private static $dir = "commands";

    public static function getCommand( $action = 'Default' )
    {
        if( preg_match( '/\W/', $action ) )
        {
            throw new Exception('Error');
        }

        $class = ucfirst(strtolower($action)) . 'Command';
        $file = self::$dir . DIRECTORY_SEPARATOR . "{$class}.php";
        if( !file_exists($file) )
        {
            throw new Exception("Error with file");
        }

        require_once ($file);
        if( !class_exists($class) )
        {
            throw new Exception("Error with class");
        }

        $cmd = new $class();
        return $cmd;
    }
}

class Controller
{
    private $context;

    function __construct()
    {
        $this->context = new CommandContext();
    }

    function getContext()
    {
        return $this->context;
    }

    function process()
    {
        $cmd = CommandFactory::getCommand( $this->context->get('action') );
        if( ! $cmd->execute( $this->context ) )
        {
            //обработка ошибки
        }
        else
        {
            //Все прошло успешно
            //Теперь отобразим результаты
        }
    }
}


//realization
$controller = new Controller();
//Эмулируем запрос пользователя
$context = $controller->getContext();
$context->addParam('action', 'login');
$context->addParam('username', 'bob');
$controller->process();
