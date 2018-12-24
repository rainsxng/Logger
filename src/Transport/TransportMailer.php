<?php


namespace Transport;
use Transport\TransportInterface;
use Monolog\Logger as Logger;
use Monolog\Handler\SwiftMailerHandler;
use Monolog\Formatter\HtmlFormatter;
class TransportMailer implements TransportInterface
{
    private $config;
    public function __construct()
    {
        $this->config = require_once __DIR__ . '/config/mailConfig.php';
    }
    public function send($subject, $messsage,$template)
    {
        $logger = new Logger('default');
        $transport = (new \Swift_SmtpTransport($this->config['host'],$this->config['port']))
            ->setUsername($this->config['username'])
            ->setPassword($this->config['password'])
            ->setEncryption($this->config['encryption']);
        ;

// Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);
        $mailerHandler = new SwiftMailerHandler($mailer, $messsage, Logger::CRITICAL);
        $mailerHandler->setFormatter(new HtmlFormatter());
        $logger->pushHandler($mailerHandler);
        $logger->addCritical('This is a critical message!');
// Create a message
        $message = (new \Swift_Message($subject))
            ->setFrom([$this->config['username'] => $this->config['username']])
            ->setTo([$this->config['username'] => $this->config['username']])
            ->setBody( require_once 'template/'.$template.'.php','text/html');
        ;
        $params  = $this->config;
        require_once 'template/example.php';
// Send the message
        $result = $mailer->send($message);
    }
}