<?php
require_once __DIR__.'/vendor/autoload.php';
use Transport\TransportMailer;
use Logger\LoggerClass;
//$sender = new TransportMailer();
//$sender->send("Важное сообщение","Просто сообщение","example");
$logger = new LoggerClass();
$logger->log();
