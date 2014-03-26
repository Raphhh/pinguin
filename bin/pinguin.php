<?php
use Pinguin\ConsoleHelper;

(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';

$consoleHelper = new ConsoleHelper();
$consoleHelper->createConsoleFromLocalConfig()->run();