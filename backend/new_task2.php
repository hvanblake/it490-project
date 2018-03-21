<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('192.168.1.3', 5672, 'admin', 'password');
$channel = $connection->channel();
$channel->exchange_declare('checklogin', 'direct', false, false, false);
$channel->queue_declare('checker', false, false, false, false);
$data = implode(' ',array_slice($argv, 1));
if (empty($data)) 
    $data == 0;
$msg = new AMQPMessage('0');
$channel->basic_publish($msg, 'checklogin', 'check');
file_put_contents('log.txt', date('Y-m-d H:i:s') . ': Verified Credentials: '."\n", FILE_APPEND);
echo " [x] Sent ", $data, "\n".PHP_EOL;
$channel->close();
$connection->close();
?>