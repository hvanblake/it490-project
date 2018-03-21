<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('192.168.1.5', 5672, 'admin', 'password');
$channel = $connection->channel();
$channel->exchange_declare('checklogin', 'direct', false, false, false);
$channel->queue_declare('hello', false, false, false, false);
$data = implode(' ',array_slice($argv, 1));
if (empty($data)) 
    $data == 1;
    
$msg = new AMQPMessage('1');
$channel->basic_publish($msg, 'checklogin', 'login');
file_put_contents('log.txt', date('Y-m-d H:i:s') . ': Verified Credentials' ."\n", FILE_APPEND);

echo " [x] Sent ", $data, "\n";
$channel->close();
$connection->close();
?>
