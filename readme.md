# Sample laravel project
This project includes two docker containers based on `php-apache` and `percona` images.

This project is under development, So I've mounted the source codes from host to the container. On production environment you should remove these volumes.

## Installation guide
Follow these steps to simply run this project.

### Clone the project
Clone this repository to your local machine using the following command
```bash
git clone 
```

### Running the containers
```bash
cd /path-to-project
docker-compose up -d 
```
### Environment variables
Setting up the container (OS) level environment variables like $USER id. So every single file which is created or modified by container users will be owned by $USER because of id mappings.
```bash
cd /path-to-project
cp .env.example .env
vim .env
```

### Bootup the application

Only the first time that you want to run the application, you need to execute the following command.
It will install the dependencies, creates .env laravel file, generates the application key and migrates the database.

```bash
cd /path-to-project
docker-compose exec --user www-data app bootup
```

#### Images/Containers

##### app
php:7.3.5-apache
##### db
percona:5.7.25

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)