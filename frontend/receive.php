<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
$connection = new AMQPStreamConnection('192.168.1.3', 5672, 'admin', 'password');
$channel = $connection->channel();
$channel->exchange_declare('checklogin', 'direct', false, false, false);
$channel->queue_declare('checker', false, false, false, false);
$channel->queue_bind('checker', 'checklogin', 'check');

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";


$callback = function($msg) {
$_SESSION['test'] = $msg->body;

header('Location: index2.php');
//  echo " [x] Received ", $msg->body, "\n";

$channel->close();
$connection->close();
};

$channel->basic_consume('checker', '', false, true, false, false, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
}
//unset($_SESSION["username"]);

//  echo " [x]";

?>
