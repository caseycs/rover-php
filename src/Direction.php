<?php
namespace Rover;

class Direction
{
    public $left, $right, $x, $y, $letter;

    public static function getAllAssoc()
    {
        $DirectionN = new self;
        $DirectionN->letter = 'N';
        $DirectionN->x = 0;
        $DirectionN->y = 1;

        $DirectionE = new self;
        $DirectionE->letter = 'E';
        $DirectionE->x = 1;
        $DirectionE->y = 0;

        $DirectionS = new self;
        $DirectionS->letter = 'S';
        $DirectionS->x = 0;
        $DirectionS->y = -1;

        $DirectionW = new self;
        $DirectionW->letter = 'W';
        $DirectionW->x = -1;
        $DirectionW->y = 0;

        $DirectionN->left = $DirectionW;
        $DirectionN->right = $DirectionE;

        $DirectionE->left = $DirectionN;
        $DirectionE->right = $DirectionS;

        $DirectionS->left = $DirectionE;
        $DirectionS->right = $DirectionW;

        $DirectionW->left = $DirectionS;
        $DirectionW->right = $DirectionN;

        $directions = array(
            'N' => $DirectionN,
            'E' => $DirectionE,
            'S' => $DirectionS,
            'W' => $DirectionW,
        );

        return $directions;
    }
}
