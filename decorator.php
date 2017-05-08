<?php
abstract class Tile
{
    abstract function getWealthFactor();
}

class Plain extends Tile
{
    private $wealthfactor = 2;

    function getWealthFactor()
    {
        return $this->wealthfactor;
    }
}

abstract class TileDecorator extends Tile
{
    protected $tile;

    function __construct( Tile $tile )
    {
        $this->tile = $tile;
    }
}

class DiamondDecorator extends TileDecorator
{
    function getWealthFactor()
    {
        return $this->tile->getWealthFactor() + 2;
    }
}

class PollutionDecorator extends TileDecorator
{
    function getWealthFactor()
    {
        return $this->tile->getWealthFactor() - 4;
    }
}



//realization
$tile = new Plain();
print $tile->getWealthFactor(); // 2


$tile = new DiamondDecorator( new Plain() );
print $tile->getWealthFactor(); //4


$tile = new PollutionDecorator(
    new DiamondDecorator( new Plain() )
);
print $tile->getWealthFactor(); //0







//For Front Controller Pattern
class firstDecorator{
    private $test1;
    function __construct($obj)
    {
        $this->test1 = $obj;
    }
}
class secondDecorator{
    private $test2;
    function __construct($obj)
    {
        $this->test2 = $obj;
    }
}
class thirdDecorator{
    private $test3;
    function __construct($obj)
    {
        $this->test3 = $obj;
    }
}

class CommandTest{}

function setDecoratorChain( $decoratorSet='', $cmd='' )
{
    $file = 'tsconfig.json';
    $config = json_decode(file_get_contents($file), true);

    $objectDecorator = new $cmd();
    foreach ($config as $keyDecoratorSet=>$item)
    {
        if($decoratorSet==$keyDecoratorSet)
        {
            foreach ($item as $className)
            {
                $objectDecorator = new $className($objectDecorator);
            }
        }
    }

    return $objectDecorator;
}

//tsconfig.json
{
  "createEntry":[
    "firstDecorator",
    "secondDecorator",
    "thirdDecorator"
  ],
  "createEntry2":[
    "secondDecorator",
    "thirdDecorator"
  ]
}

//realization
//setDecoratorChain('createEntry', 'CommandTest');
