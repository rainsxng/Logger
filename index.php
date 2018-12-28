<?php
require_once __DIR__.'/vendor/autoload.php';
use Logger\LoggerClass;
error_reporting(E_ALL & ~E_NOTICE);
$logger = new LoggerClass();
$logger->setLogFile('name.log');
$logger->registerExceptionHandler();
throw new Exception('sa');

