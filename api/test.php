<?php
//require_once __DIR__ . '/Request.php';
//require_once __DIR__ . '/Session.php';
//require_once __DIR__ . '/SpotifyWebAPI.php';
//require_once __DIR__ . '/SpotifyWebAPIException.php';

require 'vendor/autoload.php';

function getClientToken()
{
$client_id = '665123ebda09454a964a0b183fe61952'; 
$client_secret = 'c4f09a4bab7a46efb662915efae08635'; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POST,           1 );
curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' ); 
curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 

$result=curl_exec($ch);
echo $result;
}

echo getClientToken();
$session = new SpotifyWebAPI\Session(
    '665123ebda09454a964a0b183fe61952',
    'c4f09a4bab7a46efb662915efae08635',
    'http://localhost/api/test.php'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();
$accessToken = getClientToken();
print '1111111';
$token = explode(":", $accessToken);
print $token;
/*
$api->setAccessToken($accessToken);

$results = $api->search('blur', 'artist');
echo 'testing';
foreach ($results->artists->items as $artist)
{
    echo $artist->name, '<br>';
}
*/
?>
