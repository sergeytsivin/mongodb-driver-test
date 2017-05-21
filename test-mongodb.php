<?php

ini_set("mongodb.debug", "stderr");

$mongo = new MongoDB\Driver\Manager("mongodb://mymongo:27017");
//var_dump($mongo);

$filter = [ 'id' => 2 ];
$options = [
    'projection' => [ '_id' => 0 ],
];
$query = new MongoDB\Driver\Query( $filter, $options );
$rows = $mongo->executeQuery( 'test.users', $query ); // $mongo contains the connection object to MongoDB
foreach ( $rows as $r )
{
    print( $r );
}

var_dump( $mongo );