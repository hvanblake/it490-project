<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel2 = $connection2->channel();

$channel->queue_declare('login', false, false, false, false);
echo ' [*] Waiting for client login. To exit press CTRL+C', "\n";
$callback = function($msg) {
  echo " [x] Received ", $msg->body, "\n";
};
$callback2 = function($msg) {
  echo " [x] Received ", $msg->body, "\n";
};
$channel2->basic_consume('register', '', false, true, false, false, $callback2);
while(count($channel2->callbacks)) {
    $channel2->wait();
}
//$db = new mysqli ('localhost','root','july161996','users');

$channel->close();
$channel2->close();
$connection->close();
$connection2->close();


?>
