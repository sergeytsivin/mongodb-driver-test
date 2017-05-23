<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\mongodb\Connection;

class TestMongoController extends Controller
{
    public function actionDao()
    {
        ini_set( "mongodb.debug", "stderr" );

        while ( true )
        {
            /** @var Connection $mongodb */
            $mongodb = \Yii::$app->mongodb;

            $user = $mongodb->getCollection( 'users' )
                ->findOne( [ 'username' => 'admin' ] );

            echo ".";
        }
    }

    public function actionQuery()
    {
        ini_set( "mongodb.debug", "stderr" );

        while ( true )
        {
            /** @var Connection $mongodb */
            $user = ( new \yii\mongodb\Query() )->from( 'users' )
                ->where( [ 'username' => 'admin' ] )
                ->one();

            echo ".";
        }
    }
}
