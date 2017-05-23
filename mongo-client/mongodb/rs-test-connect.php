<?php
//ini_set( "mongodb.debug", "stderr" );

require_once __DIR__ . "/vendor/autoload.php";

echo "Starting\n";
$start = time();

//$connectionUri = 'mongodb://mongocluster_mongo_1:27017,mongocluster_mongo_2:27017/example?readPreference=nearest&readPreferenceTags=dc:hq&readPreferenceTags=&replicaSet=rs';

$connectionUri = 'mongodb://172.21.0.2:27017/example?replicaSet=rs&readPreference=nearest';

$mongo = new MongoDB\Client(
    $connectionUri, [
//        'serverSelectionTimeoutMS' => 500,
//        'connectTimeoutMS' => 500,
//        'socketTimeoutMS' => 5000, // set socket timeout to 5 seconds
    ]
);

$collection = $mongo->example->users;


$doc = $collection->findOne( [ 'username' => 'admin' ] );

echo "Time elapsed: " . ( time() - $start ) . "\n";
//var_dump( $doc );
//var_dump( $mongo->getManager() );

