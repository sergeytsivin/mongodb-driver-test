
# build docker image

docker build -t php56-mongodb .

# install composer

docker run --rm -it --net mynet -v "$PWD":/usr/src/myapp -w /usr/src/myapp php56-mongodb composer-setup.php
curl https://getcomposer.org/installer -o composer-setup.php

# install mongodb/mongodb

docker run --rm -it --net mynet -v "$PWD":/usr/src/myapp -w /usr/src/myapp php56-mongodb php composer.phar require --prefer-stable --prefer-dist mongodb/mongodb
