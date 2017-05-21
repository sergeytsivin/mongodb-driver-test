
# build docker image

  docker build -t php56-mongodb .

# install composer

  docker run --rm -it --net mynet -v "$PWD":/usr/src/myapp -w /usr/src/myapp php56-mongodb composer-setup.php
  curl https://getcomposer.org/installer -o composer-setup.php

# install mongodb/mongodb

  docker run --rm -it --net mynet -v "$PWD":/usr/src/myapp -w /usr/src/myapp php56-mongodb php composer.phar require --prefer-stable --prefer-dist mongodb/mongodb

# install yii2 mongodb

  docker run --name mybox -it --net mynet -v "$PWD":/usr/src/myapp -w /usr/src/myapp php56-mongodb php composer.phar global require "fxp/composer-asset-plugin:^1.3.1"
  docker commit mybox php56-mongodb

  docker run --rm -it --net mynet -v "$PWD":/usr/src/myapp -w /usr/src/myapp php56-mongodb php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic yii2-app
  docker run --rm -it --net mynet -v "$PWD":/usr/src/myapp -w /usr/src/myapp/yii2-app php56-mongodb php /usr/src/myapp/composer.phar require --prefer-dist yiisoft/yii2-mongodb
