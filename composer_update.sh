#! /bin/bash
sudo php composer.phar self-update

if [ ! -z "$1" ] && [ $1 = 'nodev' ]
then
	sudo php composer.phar update --no-dev -o
else
	sudo php composer.phar update -o
fi

cp hooks/pre-commit .git/hooks/
sudo chmod -R 0777 .git/hooks

