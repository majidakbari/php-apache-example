# Sample laravel project
This project includes two docker containers based on `php-apache` and `mysql` images.

It is under development, So I've mounted the source codes from host to the container. On production environment you should remove these volumes.

## Installation guide
Follow these steps to simply run this project.

### Clone the project
Clone this repository to your local machine using the following command
```bash
git clone 
```

### Environment variables
Setting up the container (OS) level environment variables like $USER id `WWW_DATA_USER_ID`. So every single file which is created or modified by container users will be owned by $USER because of user id mapping between the host and the containers.
```bash
cd /path-to-project
cp .env.example .env
vim .env
```


### Running the containers
Open terminal and type the following command:
```bash
docker-compose up -d 
```

### Bootup the application

Only the first time that you want to run the application, you need to execute the following command.
It will install the dependencies, creates .env laravel file, generates the application key, changes required directory permissions and migrates and seeds the database.

```bash
docker-compose exec --user www-data app bootup
```


## API Documentation
In the root of the project there is a postman collection which contains the API doc.
Also you can find the API documentation in the following address.

[API Documentation](https://documenter.getpostman.com/view/1493779/S1TPc1f6?version=latest#23c8dae8-278f-4f37-bc45-80fb8c333ddf)

## Images/Containers

`app`
php:7.3.5-apache

`db`
mysql:5.7.26

## Licence

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)