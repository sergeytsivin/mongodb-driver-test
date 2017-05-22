<?php

//ini_set( "mongodb.debug", "stderr" );

require_once __DIR__ . "/vendor/autoload.php";

$connectionUri = 'mongodb://mongocluster_mongo_2:27017,mongocluster_mongo_3:27017/example?replicaSet=rs&readPreference=primary';

echo "Starting\n";

$mongo = new MongoDB\Client(
    $connectionUri, [
        'connectTimeoutMS' => 10000,
        'socketTimeoutMS' => 5000, // set socket timeout to 5 seconds
    ]
);

$collection = $mongo->example->users;

$insertManyResult = $collection->insertMany(
    [
        [
            'username' => 'admin',
            'email' => 'admin@example.com',
            'name' => 'Admin User',
        ],
        [
            'username' => 'test',
            'email' => 'test@example.com',
            'name' => 'Test User',
        ],
        [
            'username' => 'test2',
            'email' => 'test2@example.com',
            'name' => 'Test User 2',
        ],
    ]
);

printf( "Inserted %d document(s)\n", $insertManyResult->getInsertedCount() );

var_dump( $insertManyResult->getInsertedIds() );

var_dump( $mongo->getManager() );
