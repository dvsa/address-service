#!/bin/sh

tar -czf ../release/olcs-postcode/$VERSION.tar.gz \
composer.phar composer.json composer.lock config module public vendor \
--exclude="config/autoload/local.php" --exclude="config/autoload/local.php.dist"
