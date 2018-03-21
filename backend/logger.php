<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;


$connection = new AMQPStreamConnection('192.168.1.6', 5672, 'admin', 'password');
$channel = $connection->channel();
$channel->queue_declare('log', false, false, false, false);
$channel->exchange_declare('checklogin', 'direct', false, false, false);
$channel->queue_bind('log', 'checklogin', 'logger');
echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";


$callback = function($msg) 
{
  echo " [x] Received ", $msg->body, "\n";
  
  $string = $msg->body;

file_put_contents('centralLog.txt', $string, FILE_APPEND);
//sudo chmod -R 777 $folder name




};
$channel->basic_consume('log', '', false, true, false, false, $callback);
while(count($channel->callbacks)) 
{
    $channel->wait();
}


$channel->close();
$connection->close();

?>