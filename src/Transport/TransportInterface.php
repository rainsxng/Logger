<?php
namespace Transport;
 interface TransportInterface{
     public function send($subject,$messsage,$template);
 }