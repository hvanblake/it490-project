<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('192.168.1.6', 5672, 'admin', 'password');
$channel = $connection->channel();
$channel->exchange_declare('checklogin', 'direct', false, false, false);
$channel->queue_declare('reg', false, false, false, false);
$channel->queue_declare('log', false, false, false, false);


$msg = new AMQPMessage($username . ':' . $password);
//$channel->basic_publish($msg, '', 'hello');
$channel->basic_publish($msg, 'checklogin', 'register');
file_put_contents('log.txt', date('Y-m-d H:i:s') . ': Attempted registration from: ' . gethostname() ."\n", FILE_APPEND);

$msg2 = new AMQPMessage(date('Y-m-d H:i:s') . ': Attempted registration from: ' . gethostname() ."\n");
$channel->basic_publish($msg2, 'checklogin', 'logger');

header('Location: receive.php');

$channel->close();
$logchannel->close();
$connection->close();

?>
