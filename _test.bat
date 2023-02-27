@echo off
php ./phpunit/phpunit-9.6.4.phar --colors --testdox --bootstrap app/bootstrap.php tests

pause