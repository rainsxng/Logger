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
use Monolog\Handler\SwiftMailerHandler;
use Transport\TransportMailer;
class LoggerClass
{
    private $config;
        public function log(){
            $this->config = require_once __DIR__.'\config\mailConfig.php';
            $transport = (new \Swift_SmtpTransport($this->config['host'],$this->config['port']))
                ->setUsername($this->config['username'])
                ->setPassword($this->config['password'])
                ->setEncryption($this->config['encryption']);
            ;

// Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);
        $log = new Logger('name');
            $message = (new \Swift_Message("произошла ошибка"))
                ->setFrom([$this->config['username'] => $this->config['username']])
                ->setTo([$this->config['username'] => $this->config['username']])
                ->setContentType('text/html');
            ;
        $log->pushHandler(new SwiftMailerHandler($mailer, $message));

        $log->addWarning('Foo');
        $log->addError('Bar');
    }

    }
