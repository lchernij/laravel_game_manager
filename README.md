# Game Manager Project

## About

This is a simple example of a API builded with Laravel 8 to manage my personal list of games.
The project will include Steam API integration.

## Enviroment settings

- WSL2 (optional)
- Ubuntu 20.04
- Windows Terminal (optional)
- php 7.4
- Composer
- Laravel 8
- Github

## Installation

### WSL2 (optional)

Follow the instructions in this [link](https://pureinfotech.com/install-windows-subsystem-linux-2-windows-10)

### Ubuntu 20.04

Available in windows store

After install, run this follow commands to update and upgrade the O.S.

```php
sudo apt update

sudo apt upgrade
```

### Windows Terminal (optional)

Available in windows store, this is a nice program to management command line in windows.

### Composer

```php
sudo apt install composer
```

### PHP 7.4 dependencies

- php7.4-xml

to install, run this command:

```php
sudo apt install php7.4-xml
```

### Options

#### Creatre a new project

```php
composer create-project laravel/laravel _name_for_you_project_
```

#### Initialize github

```php
# if is you first time with git in the machine, you need add this to:

#to generate a SSH Key to add in github
ssh-keygen

# You can use this command to get you ssh key
cat /home/__user_name__/.ssh/id_rsa.pub
## cat /home/lchernij/.ssh/id_rsa.pub

# General info
git config --global user.email "you@example.com"
git config --global user.name "Your Name"
```

Inside the project folder, run this commands to create and send the project to github

```php
git init .

git add .

git commit -m "First Commit"

git remote add origin git@github.com:__your_project_repository__.git
## git remote add origin git@github.com:lchernij/laravel_game_manager.git

git branch -M main

git push -u origin main
```