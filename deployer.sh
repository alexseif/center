export PATH="$PATH:/usr/bin"
git pull
export SYMFONY_ENV=prod
php -d allow_url_fopen=1 -d php_openssl=1 -d open_basedir=NULL composer.phar install --no-dev --optimize-autoloader 
php bin/console cache:clear --env=prod --no-debug
php bin/console doctrine:migrations:migrate --no-debug --no-interaction --env=prod 
php bin/console assets:install --env=prod 