<?php

require_once __DIR__ . "/vendor/autoload.php";

//$connectionUri = 'mongodb://mongocluster_mongo_1:27017,mongocluster_mongo_2:27017/example?readPreference=nearest&readPreferenceTags=dc:hq&readPreferenceTags=&replicaSet=rs';
$connectionUri = 'mongodb://mongocluster_mongo_1:27017,mongocluster_mongo_2:27017/example?replicaSet=rs&readPreference=nearest';

$mongo = new MongoDB\Client(
    $connectionUri, [
        'connectTimeoutMS' => 1000,
        'socketTimeoutMS' => 5000, // set socket timeout to 5 seconds
    ]
);

$collection = $mongo->example->users;

