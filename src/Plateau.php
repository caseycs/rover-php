<?php
namespace Rover;

class Plateau
{
    public $x, $y, $map, $rovers;

    public function __construct($x, $y)
    {
        if ($x < 0 || $y < 0) throw new \Exception;

        $this->x = $x;
        $this->y = $y;

        for ($i = 0; $i <= $x; $i ++) {
            for ($j = 0; $j <= $x; $j ++) {
                $this->map[$i][$j] = false;
            }
        }
    }

    public function landRover(Rover $Rover)
    {
        if ($Rover->x < 0 || $Rover->x > $this->x) throw new \Exception;
        if ($Rover->y < 0 || $Rover->y > $this->y) throw new \Exception;

        if ($this->map[$Rover->x][$Rover->y] !== false) throw new \Exception;

        $this->rovers[] = $Rover;
        $this->map[$Rover->x][$Rover->y] = $Rover;
    }

    public function run()
    {
        foreach ($this->rovers as $Rover) {
            // echo "{$Rover->x} {$Rover->y} {$Rover->direction->letter}\n";
            foreach($Rover->path as $cmd) {
                // echo "{$cmd}\n";
                if ($cmd === 'L') {
                    $Rover->direction = $Rover->direction->left;
                } elseif ($cmd === 'R') {
                    $Rover->direction = $Rover->direction->right;
                } else {
                    $x_new = $Rover->x + $Rover->direction->x;
                    $y_new = $Rover->y + $Rover->direction->y;

                    if ($x_new < 0 || $x_new > $this->x) throw new \Exception;
                    if ($y_new < 0 || $y_new > $this->y) throw new \Exception;
                    if ($this->map[$x_new][$y_new] !== false) throw new \Exception;

                    $this->map[$Rover->x][$Rover->y] = false;

                    $Rover->x = $x_new;
                    $Rover->y = $y_new;

                    $this->map[$x_new][$y_new] = $Rover;
                }
            }
        }
    }

    public function outputResult()
    {
        $output = '';
        foreach ($this->rovers as $Rover) {
            $output .= "{$Rover->x} {$Rover->y} {$Rover->direction->letter}\n";
        }
        return $output;
    }
}
