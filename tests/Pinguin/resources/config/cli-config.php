<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = false;

$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => '',
    'dbname' => 'pinguin',
);

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__), $isDevMode);

$entityManager = EntityManager::create($dbParams, $config);
$commands = array();