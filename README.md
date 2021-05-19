# NullHubMVC-Base

this is a base setup for my home automation and similar projects that i'm running on raspberry pis. the folder setup is to help me keep stuff organized and also because the folders have pretty icons in visual studio code.

i'm going to try to get the basic features i want for the different pis. and i'm probably going to see about forking this repo for the different projects that will use this base.

most of this project is currently private but my goal is to make as much of it available as open source and try to include instructions for setting up the different raspberry pi devices.

i apologize for anybody looking for something useful now... i'll probably focus mostly on some of the smaller device projects before i'm ready to make key features like the hub available. but if any of this code helps you with something you're working on it that's awesome.

## Setup

first run the raspberry pi config wizard and get everything setup so you can ssh into the pi and it's connected to your network

```bash
sudo raspi-config
```

### All in One super command to install everything

this is what i've used to setup a few raspberry pi zeros...

```bash
sudo apt-get update && sudo apt-get upgrade -y && sudo apt-get install apache2 -y && sudo a2enmod rewrite && sudo service apache2 restart && sudo apt-get install php -y && sudo apt-get install libapache2-mod-php -y && sudo apt-get install mariadb-server -y && sudo apt-get install php-mysql -y && sudo service apache2 restart && sudo apt-get install python -y && sudo apt-get install python-serial -y && sudo apt-get install python-serial -y && sudo pip install urllib && sudo ln -s /var/www/html www && sudo chown -R pi:pi /var/www/html && sudo chmod 777 /var/www/html
```

### Individual commands

```bash
sudo apt-get update
```
```bash
sudo apt-get upgrade -y
```
```bash
sudo apt-get install apache2 -y
```
```bash
sudo a2enmod rewrite
```
```bash
sudo service apache2 restart
```
```bash
sudo apt-get install php -y
```
```bash
sudo apt-get install libapache2-mod-php -y
```
```bash
sudo apt-get install mariadb-server -y
```
```bash
sudo apt-get install php-mysql -y
```
```bash
sudo service apache2 restart
```
```bash
sudo apt-get install python -y
```
```bash
sudo apt-get install python-serial -y
```
```bash
sudo apt-get install python-pip -y
```
```bash
sudo pip install urllib
```
```bash
sudo ln -s /var/www/html www
```
```bash
sudo chown -R pi:pi /var/www/html
```
```bash
sudo chmod 777 /var/www/html
```

### Setup the mysql database

```bash
sudo mysql -u root
```
```mysql
[MariaDB] use mysql;
[MariaDB] update user set plugin='' where User='root';
[MariaDB] flush privileges;
[MariaDB] \q
```

This needs to be followed by the following command:
```bash
mysql_secure_installation
```

```bash
sudo ln -s /var/www/html www && sudo chown -R pi:pi www && sudo chmod 777 www
```

## Tools

favicon generator: <https://www.favicon-generator.org/>
