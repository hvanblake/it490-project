<?php
require_once 'worker.php';
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('192.168.1.5', 5672, 'admin', 'password');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);
$channel->exchange_declare('checklogin', 'direct', false, false, false);
$msg1 = new AMQPMessage($data);
$channel->basic_publish($msg2, 'checklogin', 'login');
echo " [x] Sent ", $data, "\n";
$channel->close();
$connection->close();
?>
