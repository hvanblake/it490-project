<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
$connection2 = new AMQPStreamConnection('192.168.1.5', 5672, 'admin', 'password');
$channel2 = $connection2->channel();
$channel2->exchange_declare('checklogin', 'direct', false, false, false);
$channel2->queue_declare('log', false, false, false, false);
$channel2->queue_bind('log', 'checklogin', 'logger');

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";


$callback = function($msg) {
echo " [x] Received ", $msg->body, "\n";

};

$channel2->basic_consume('log', '', false, true, false, false, $callback);
while(count($channel2->callbacks)) {
    $channel2->wait();
}
echo " [x]";
$channel2->close();
$connection2->close();
?>
