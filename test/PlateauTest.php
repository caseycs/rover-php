<?php
class PlateauTest extends PHPUnit_Framework_TestCase
{
    public function provider_testRotateMove()
    {
        return array(
            array(2,2,'N',array('L'),2,2,'W'),
            array(2,2,'N',array('L','L'),2,2,'S'),
            array(2,2,'N',array('L','L','L'),2,2,'E'),
            array(2,2,'N',array('L','L','L','L'),2,2,'N'),
            array(2,2,'N',array('R'),2,2,'E'),
            array(2,2,'N',array('R','R'),2,2,'S'),
            array(2,2,'N',array('R','R','R'),2,2,'W'),
            array(2,2,'N',array('R','R','R','R'),2,2,'N'),
            array(2,2,'N',array('M'),2,3,'N'),
        );
    }

    /**
     * @dataProvider provider_testRotateMove
     */
    public function testRotateMove($x, $y, $direction, array $commands, $result_x, $result_y, $result_direction)
    {
        $directions = Rover\Direction::getAllAssoc();
        $Plateau = new \Rover\Plateau(4,4);

        $Rover = new \Rover\Rover();
        $Rover->x = $x;
        $Rover->y = $y;
        $Rover->direction = $directions[$direction];
        $Rover->path = $commands;

        $Plateau->landRover($Rover);
        $Plateau->run();

        $this->assertEquals($result_x, $Rover->x);
        $this->assertEquals($result_y, $Rover->y);
        $this->assertSame($directions[$result_direction], $Rover->direction);
    }

    /**
     * @expectedException \Exception
     */
    public function testCollisionStart()
    {
        $directions = Rover\Direction::getAllAssoc();
        $Plateau = new \Rover\Plateau(4,4);

        $Rover1 = new \Rover\Rover();
        $Rover1->x = 2;
        $Rover1->y = 2;
        $Rover1->direction = $directions['N'];
        $Rover1->path = array();

        $Plateau->landRover($Rover1);

        $Rover2 = new \Rover\Rover();
        $Rover2->x = 2;
        $Rover2->y = 2;
        $Rover2->direction = $directions['N'];
        $Rover2->path = array();

        $Plateau->landRover($Rover2);
    }

    /**
     * @expectedException \Exception
     */
    public function testCollisionMove()
    {
        $directions = Rover\Direction::getAllAssoc();
        $Plateau = new \Rover\Plateau(4,4);

        $Rover1 = new \Rover\Rover();
        $Rover1->x = 2;
        $Rover1->y = 2;
        $Rover1->direction = $directions['N'];
        $Rover1->path = array();

        $Plateau->landRover($Rover1);

        $Rover2 = new \Rover\Rover();
        $Rover2->x = 2;
        $Rover2->y = 1;
        $Rover2->direction = $directions['N'];
        $Rover2->path = array('M');

        $Plateau->landRover($Rover2);

        $Plateau->run();
    }

    /**
     * @expectedException \Exception
     */
    public function testOutOfRangeLand()
    {
        $directions = Rover\Direction::getAllAssoc();
        $Plateau = new \Rover\Plateau(4,4);

        $Rover = new \Rover\Rover();
        $Rover->x = 5;
        $Rover->y = 5;
        $Rover->direction = $directions['N'];
        $Rover->path = array('M');

        $Plateau->landRover($Rover);
    }

    /**
     * @expectedException \Exception
     */
    public function testOutOfRangeX()
    {
        $directions = Rover\Direction::getAllAssoc();
        $Plateau = new \Rover\Plateau(4,4);

        $Rover = new \Rover\Rover();
        $Rover->x = 4;
        $Rover->y = 4;
        $Rover->direction = $directions['N'];
        $Rover->path = array('M');

        $Plateau->landRover($Rover);
        $Plateau->run();
    }

    /**
     * @expectedException \Exception
     */
    public function testOutOfRangeY()
    {
        $directions = Rover\Direction::getAllAssoc();
        $Plateau = new \Rover\Plateau(4,4);

        $Rover = new \Rover\Rover();
        $Rover->x = 4;
        $Rover->y = 4;
        $Rover->direction = $directions['E'];
        $Rover->path = array('M');

        $Plateau->landRover($Rover);
        $Plateau->run();
    }
}
