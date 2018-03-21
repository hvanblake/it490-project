<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
    {
        $msg = $argv[1];
    }
    else
    {
        $msg = "test message";
    }

$request = array();
$request['type'] = "Login";
$request['username'] = "guest";
$request['password'] = "guest";
$request['message'] = $msg;
$response = $client->send_request($request);

$payload = json_encode($response)
echo payload

?>