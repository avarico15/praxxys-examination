### Project install
`
https://github.com/avarico15/praxxys-examination.git
`

### Vendor folder and other files
`
composer update
`
Copy **.env.example** file rename to **.env**

### Project key generate
`
php artisan key:generate
`
### Database connection
Create database and create find these fields in the .env file and enter your information

`
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=praxxys-exam
DB_USERNAME=root
DB_PASSWORD=

`

### Cache clear
`
php artisan config:cache
`

### Make migrate
`
php artisan migrate
`

### Make seed
`
php artisan db:seed
`

### Run project
`
php artisan serve
`  
### Login info 
`
email    : admin@example.com
password : 123456
`
