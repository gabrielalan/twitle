<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Twitle\Config\Doctrine;

$loader = require __DIR__.'/vendor/autoload.php';
$loader->add('Twitle', __DIR__.'/src');

return ConsoleRunner::createHelperSet(Doctrine::getEntityManager(__DIR__));