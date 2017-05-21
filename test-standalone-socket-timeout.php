<?php
/**
 * When standalone node goes offline, the process hands waiting to read from socket
 * until socketTimeoutMS is reached which is 5 minutes by default.
 */
ini_set( "mongodb.debug", "stderr" );

require_once __DIR__ . "/vendor/autoload.php";

$connectionUri = 'mongodb://mymongo:27017';

$mongo = new MongoDB\Client(
    $connectionUri,
    [
        'connectTimeoutMS' => 1000,
        'socketTimeoutMS' => 5000, // set socket timeout to 5 seconds
    ]
);

$collection = $mongo->example->users;

while ( true )
{
    $doc = $collection->findOne( [ 'username' => 'admin' ] );
    echo ".";
}

