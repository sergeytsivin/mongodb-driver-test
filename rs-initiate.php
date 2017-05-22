<?php

require_once __DIR__ . "/vendor/autoload.php";

$connectionUri = 'mongodb://mongocluster_mongo_1:27017';

$mongo = new MongoDB\Client(
    $connectionUri, [
        'connectTimeoutMS' => 1000,
        'socketTimeoutMS' => 5000, // set socket timeout to 5 seconds
    ]
);

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

// https://docs.mongodb.com/v2.6/reference/command/replSetInitiate/#dbcmd.replSetInitiate

$cursor = $mongo->admin->command( [ 'replSetInitiate' => $config ] );

var_dump( $cursor->toArray()[ 0 ] );