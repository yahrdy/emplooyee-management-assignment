# Please follow the steps to run this project

### Clone the project
`git clone git@github.com:yahrdy/employee-assignment-backend.git`

### Install dependencies
`composer install`

- Copy/rename .env.example file to .env
- Create a database and add database credentials to the .env file
- Execute command `php artisan key:generate`
- Execute command `php artisan migrate`
- Execute command `php artisan passport:install`

###For database seeding
`php artisan db:seed`

###For executing test
`php artisan test`
