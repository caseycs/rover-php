<?php
require 'vendor/autoload.php';

//fill directions objects
$directions = Rover\Direction::getAllAssoc();

//input
$input = file('input.txt');

//plateau
$tmp = array_shift($input);
list($x, $y) = explode(' ', $tmp);
$Plateau = new Rover\Plateau($x, $y);

//rovers fill
for ($i = 0; $i < count($input); $i +=2) {
	$pos = explode(' ', $input[$i]);

	$pos[0] = (int)$pos[0];
	$pos[1] = (int)$pos[1];

	if (!isset($directions[trim($pos[2])])) throw new Exception;

	$commands = str_split(trim($input[$i + 1]));
	foreach ($commands as $cmd) {
		if ($cmd !== 'R' && $cmd !== 'L' && $cmd !== 'M') throw new Exception;
	}

	$Rover = new Rover\Rover;
	$Rover->x = $pos[0];
	$Rover->y = $pos[1];
	$Rover->direction = $directions[trim($pos[2])];
	$Rover->path = $commands;

	$Plateau->landRover($Rover);
}

//let's ride!
$Plateau->run();
echo $Plateau->outputResult();
