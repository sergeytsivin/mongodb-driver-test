<?php

require_once __DIR__ . "/vendor/autoload.php";

$connectionUri = 'mongodb://mymongo:27017';

$collection = ( new MongoDB\Client( $connectionUri ) )->example->users;

$insertOneResult = $collection->insertOne(
    [
        'username' => 'admin',
        'email' => 'admin@example.com',
        'name' => 'Admin User',
    ]
);

printf( "Inserted %d document(s)\n", $insertOneResult->getInsertedCount() );

var_dump( $insertOneResult->getInsertedId() );

$insertManyResult = $collection->insertMany([
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
]);

printf("Inserted %d document(s)\n", $insertManyResult->getInsertedCount());

var_dump($insertManyResult->getInsertedIds());
