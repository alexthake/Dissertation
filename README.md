# Motivate Webapp

Welcome to Motivate, a Dissertation Project by Alex Thake

To view the application online, please click [here](http://ec2-34-240-121-125.eu-west-1.compute.amazonaws.com/)
To run the application locally for development purposes, please use the following instructions.

## Installation

To set up the project locally, begin by cloning the repository to your local machine.

If you don't already have docker, install docker for windows and start it up.

#### Laradock Method
This project uses [Laradock](http://laradock.io/) to facilitate local testing.

Change to the laradock directory through the commandline
`cd laradock`
Then, create an .env file by copying the env-example
`cp env-example .env`
Use docker-compose to run the containers
`docker-compose up -d nginx mysql phpmyadmin redis workspace `

Then, change the directory back, and enter the motivate directory
`cd ../`
`cd motivate`
And set the following options in the motivate .env file
`DB_HOST=mysql`
`REDIS_HOST=redis`
`QUEUE_HOST=beanstalkd`

The project should be running in the browser at:
`http://localhost`

#### Basic Docker Method
This is another option for running locally should laradock have trouble

Change to the motivate directory through the commandline
`cd motivate`
Then, create an .env file by copying the env-example
`cp env-example .env`

Run the containers with the command
`docker-compose up -d`

Enter the container with commandline
`docker-compose exec app bash`
And generate an app key, and run migrations
`php artisan key:generate`
`php artisan migrate`

The project should be running in the browser at:
`http://localhost`
or 
`127.0.0.1`

### Development
The project should have all dependencies installed automatically through docker, however a list of manually included libraries/frameworks has been included for prosperity.

[Laravel 6.x](http://laravel.com/docs/6.x)
[Laradock](http://laradock.io/)
[Vue.js](https://vuejs.org/)
[Bootstrap](https://getbootstrap.com/)
[Bootstrap-Vue](https://bootstrap-vue.org/)
[craftable](https://www.getcraftable.com/) (not used in live)
[Moment.js](https://momentjs.com/docs/)
[vue-chartjs](https://vue-chartjs.org/)
