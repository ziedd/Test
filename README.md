Symfony Standard Edition 2.8
========================
1/Installation
========================
Merci de tapper les commandes ci-dessous:
----------------------------------------
-composer install
----------------------------------------
-php app/console assets:install
----------------------------------------
-php app/console doctrine:database:create
----------------------------------------
-php app/console doctrine:schema:update
----------------------------------------
-php app/console doctrine:fixtures:load -n
----------------------------------------
-php app/console server: run
----------------------------------------
2/Test
=========================
Pour le test fonctionnelle  merci de tapper:
---------------------------------------
-bin/phpunit -c app/  src/AppBundle/Tests/Controller/EmailContactTest
---------------------------------------
ZIED CHALLOUF@2018

