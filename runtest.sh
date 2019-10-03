#!/bin/bash
echo "The script you are running has basename `basename "$0"`, dirname `dirname "$0"`"
echo "The present working directory is `pwd`"
sudo apt -y update
sudo apt -y install php
sudo apt install -y composer
composer update
sudo php index.php 1
sudo php index.php 2
sudo php index.php 3