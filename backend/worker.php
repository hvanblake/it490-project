<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;


$connection = new AMQPStreamConnection('192.168.1.6', 5672, 'admin', 'password');
$channel = $connection->channel();
//$channel->queue_declare('hello', false, false, false, false);
$channel->exchange_declare('checklogin', 'direct', false, false, false);
$channel->queue_declare('hello', false, false, false, false);
$channel->queue_bind('hello', 'checklogin', 'login');
echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";


function validateUser($db,$credentials)
{
//$query = "select * from musicapp_database where username = '$credentials[0]';";
$query = "select * from users where userName = '$credentials[0]';";
$results = $db->query($query);
if (!$results)
    {
            
        echo "error with results: ".$db->error.PHP_EOL;
        return 0;
    } 
$count = mysqli_num_rows($results);
if (empty($count))
    {
        echo "User does not exsits"."\n";
        shell_exec('php new_task2.php');
        echo "working..."."\n";
        return false;
        echo "working2..."."\n";
    }
    else
    {
        shell_exec('php new_task.php');
        return true;
    }
};
$callback = function($msg) 
{
  echo " [x] Received ", $msg->body, "\n";
  
  $credentials = explode(":", $msg->body);
  
  //$db = new mysqli ('192.168.1.2','joel3','password','musicapp_database');
  $db = new mysqli ('localhost','root','july161996','IT490Project');
  if ($db->connect_errno > 0)
{
    
           echo __FILE__.__LINE__."failed to connect to database re:".$db->connect_error.PHP_EOL;
      exit(0);
}
validateUser($db,$credentials);



$db->close();
};
$channel->basic_consume('hello', '', false, true, false, false, $callback);
while(count($channel->callbacks)) 
{
    $channel->wait();
}


$channel->close();
$connection->close();

?>
