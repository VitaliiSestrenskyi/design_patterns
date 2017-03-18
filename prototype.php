<?
/**
 * Class TerrainFactory - Prototype
 */
class TerrainFactory
{
    private $sea;
    private $forest;
    private $plains;

    function __construct( Sea $sea, Plains $plains, Forest $forest )
    {
        $this->sea    = $sea;
        $this->plains = $plains;
        $this->forest = $forest;
    }

    public function getSea()
    {
        return clone $this->sea;
    }

    public function getPlains()
    {
        return clone $this->plains;
    }

    public function getForest()
    {
        return clone $this->forest;
    }
}


//realization
$factory = new TerrainFactory( new EarchSea(),
                                new EarthPlains(),
                                new EarthForest() );




