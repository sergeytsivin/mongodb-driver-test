# Overview

This project creates a Docker-based environment for testing features of PHP mongo client drivers in respect to fail-over scenarios.
The enviornment consists of test mongo cluster and a number of mongo clients/libraries.

# Building PHP docker-image

Before we can start we need a docker image with PHP and both mongo and mongodb extensions installed,
which can be created with this command:

    docker build -t php56-mongodb .

# Mongo cluster

## Create replica set

We create a replica set with 3 members as described in [this article](http://www.sohamkamani.com/blog/2016/06/30/docker-mongo-replica-set/)
But instead of starting containers manually we will employ docker compose,
see [this good article] (http://geekyplatypus.com/dockerise-your-php-application-with-nginx-and-php7-fpm/)

The `docker-compose.yml` file is provided in the `/mongo-cluster/`. From within this directory execute:
    docker-compose up

The in another console:

    docker-compose scale mongo=3

This will create 3 containers: mongocluster_mongo_1, mongocluster_mongo_2 and mongocluster_mongo_3.
Please note that full container names will resolve to IP addresses from within the `mongocluster_mynet` network

You can run mongo console from within one of the containers:

    docker exec -it mongocluster_mongo_1 mongo

## Configure replica set

Now mongo instances are running but are not yet configured as a replica set.
We will use a PHP script to initiate the replica set:

    docker run --rm -it --net mongocluster_mynet -v "$PWD":/myapp -w /myapp php56-mongodb php rs-initiate.php

Now  mongocluster_mongo_1 should become PRIMARY, because rs-initiate.php connects there.

## Populate database with some records

docker run --rm -it --net mongocluster_mynet -v "$PWD":/myapp -w /myapp php56-mongodb php rs-test-insert.php


# Mongo clients/libraries

## Install composer

    curl https://getcomposer.org/installer -o composer-setup.php
    docker run --rm -it -v "$PWD":/myapp -w /myapp php56-mongodb php composer-setup.php

## Install mongodb/mongodb

From within the /www/mongodb-driver-test/mongo-client/mongodb install

    docker run --rm -it -v "$PWD":/myapp -w /myapp/mongo-client/mongodb php56-mongodb php composer.phar require --prefer-stable --prefer-dist mongodb/mongodb

## install yii2 mongodb (for the first time -- skip if you have cloned this repository)

    docker run --name mybox -it --net mynet -v "$PWD":/myapp -w /myapp php56-mongodb php composer.phar global require "fxp/composer-asset-plugin:^1.3.1"
    docker commit mybox php56-mongodb

    docker run --rm -it --net mynet -v "$PWD":/myapp -w /myapp/mongo-client php56-mongodb php /myapp/composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic yii2-mongodb
    docker run --rm -it --net mynet -v "$PWD":/myapp -w /myapp/mongo-client/yii2-mongodb php56-mongodb php /myapp/composer.phar require --prefer-dist yiisoft/yii2-mongodb

## isntall yii2 mongodb (when project is already created)

    docker run --rm -it -v "$PWD":/myapp -w /myapp/mongo-client/yii2-mongodb php56-mongodb php /myapp/composer.phar install --prefer-dist

# Testing



