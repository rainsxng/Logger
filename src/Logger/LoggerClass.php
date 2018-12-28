<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 24.12.2018
 * Time: 17:50
 */
namespace Logger;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;
class LoggerClass extends ErrorHandler
{
    private static $logger;

    public function __construct()
    {
        self::$logger = new Logger('log_channel');
        parent::__construct(self::$logger);
        ErrorHandler::register(self::$logger);
    }
    public function setLogFile($filename)
    {
        self::$logger->pushHandler(new StreamHandler($filename, Logger::WARNING));
    }

}
