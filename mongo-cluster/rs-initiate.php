<?php
/**
 * Initiate replica set
 *
 * see: https://docs.mongodb.com/v2.6/reference/command/replSetInitiate/#dbcmd.replSetInitiate
 *
 */
$connectionUri = 'mongodb://mongocluster_mongo_1:27017';
$config = [
    "_id" => "rs",
    "members" => [
        [
            "_id" => 0,
            "host" => "mongocluster_mongo_1:27017"
        ],
        [
            "_id" => 1,
            "host" => "mongocluster_mongo_2:27017"
        ],
        [
            "_id" => 2,
            "host" => "mongocluster_mongo_3:27017"
        ]
    ]
];

$manager = new MongoDB\Driver\Manager( $connectionUri );
$command = new MongoDB\Driver\Command( [ 'replSetInitiate' => $config ] );

$cursor = $manager->executeCommand( 'admin', $command );

$response = $cursor->toArray()[ 0 ];

var_dump( $response );
