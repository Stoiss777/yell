<?php

require_once 'AppException.php';
require_once 'Board.php';
require_once 'shapes/Shape.php';
require_once 'shapes/Circle.php';
require_once 'shapes/Square.php';
require_once 'Builder.php';


$builder = new Builder;
$builder->createBoard();
$builder->drawShapes(empty($_GET['shapes'])? array(): unserialize($_GET['shapes']));
$builder->getBoard()->display();

