#!/bin/sh

tar -czf ../release/address-service/$VERSION.tar.gz \
composer.phar composer.json composer.lock init_autoloader.php \
config module public vendor \
--exclude="config/autoload/local.php" --exclude="config/autoload/local.php.dist"
