# Larclad
![Laravel version](https://img.shields.io/badge/laravel-10-blue)
[![License](https://img.shields.io/badge/license-MIT-success)](https://opensource.org/licenses/MIT)

Larclad is a classified ads CMS based on Laravel Framework

## Requirements
- PHP 8.1+
- PostgreSQL 13+
- Composer 2.2.0+
- NPM
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- PGSQL PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Imagick PHP Extension



## How to install?
- Create a PostgreSQL database 
- Create and edit .env file, don't forget to set `APP_DEBUG` variable to false in production environment
- Run `composer install --optimize-autoloader --no-dev`
- Run `npm install`
- Run `npx mix --production`
- Run `php artisan key:generate`
- Run `php artisan storage:link`
- Run `php artisan migrate`
- Run `php artisan db:seed` (if you already changed `APP_ENV` variable to `production` you need to run it with `--force` flag)
- The default user will have an email address from the .env file (Look for `MAIL_FROM_ADDRESS` variable) and `CHANG3_me_IMM3DIAT3LY` password
- Run `php artisan config:cache`
- Run `php artisan route:cache`
- Run `php artisan view:cache`

## License
The Larclad is open-sourced software and licensed under the [MIT license](https://opensource.org/licenses/MIT).
