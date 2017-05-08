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

