<?php

echo "MONGO Starting\n";
$start = time();

//$connectionUri = 'mongodb://mongocluster_mongo_1:27017,mongocluster_mongo_2:27017/example?readPreference=nearest&readPreferenceTags=dc:hq&readPreferenceTags=&replicaSet=rs';

$connectionUri = 'mongodb://172.21.0.2:27017,172.21.0.3:27017/example?replicaSet=rs&readPreference=nearest';

try
{

    $mongo = new MongoClient(
        $connectionUri, [
//            'connectTimeoutMS' => 10000,
//        'socketTimeoutMS' => 5000, // set socket timeout to 5 seconds
        ]
    );

    $collection = $mongo->example->users;

    $doc = $collection->findOne( [ 'username' => 'admin' ] );

    //var_dump( $doc );
    //var_dump( $mongo->getManager() );

}
catch ( Exception $e )
{
    echo 'Exception: ' . $e->getMessage() . PHP_EOL;
}

echo "Time elapsed: " . ( time() - $start ) . "\n";
