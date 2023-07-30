<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Laravel Multi Model Authentication

This package demonstrates the usage of authentication via different Models. This app is using [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze) as the authentication system.
For further separation of concerns this app uses the [nwidart/modules](https://nwidart.com/laravel-modules/v6/introduction) package. If you are not familiar with that package, I highly suggest reading the documentation before continuing here.

## Installation

Once you cloned this project, run the regular steps.

```shell
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Optionally you can run this with docker.

```shell
docker-compose up -d --build
```

## Usage

To test the application, you can visit http://localhost:8000/register OR http://localhost:8000/consumer/register
After registration, you will realize that the usual registration URL will create a record in the `users` table, while the registration at /consumer/register will create a record in the `consumers` table.

This will of course allow you to register with the same E-Mail twice (as different models).

## Use Cases
This template can be used to implement your next B2B or B2C or B2B2C application, where you need a clear separation of your users. I'm sure you will be able to find use-cases for yourself.

### Preface
I followed [this](https://www.youtube.com/watch?v=vcYAS_ZBJ6Q&list=PL8z-YHNIa8wksXALnv_PWPukBAr86pt7n) tutorial. Although it talks about Jetstream, I implemented it with Breeze. I might follow up soon with a Jetstream Version of this app.

## Explanation

> Modules\Consumer\Models\Consumer.php

This is the new Model which extends Authenticatable. The database columns are the same as with User.php. You would implement your relations in that Model as usual, e.g. `bookings()`.

---
> Modules\Consumer\Routes\web.php | Modules\Consumer\Routes\auth.php

Here you will find very similar routes compared to `routes/web.php` & `routes/auth.php`. The only differences are the middlewares used and the names and route group.
For further details, take a look into `Modules\Consumer\Providers\RouteServiceProvider @ mapWebRoutes`. You will find the group-prefix and naming there.

---
> config/auth.php

This config comes with all Laravel applications with a very good explanation how you can use multiple guards. Here I have added three things:

```php
'guards' => [
    'web' => [...]
    'consumer' => [
        'driver' => 'session',
        'provider' => 'consumers',
    ],
],
```
```php
'providers' => [
    'users' => [...]
    'consumers' => [
        'driver' => 'eloquent',
        'model' => Modules\Consumer\Models\Consumer::class,
    ],
],
```
```php
'passwords' => [
    'users' => [...]
    'consumers' => [
        'provider' => 'consumers',
        'table' => 'password_reset_tokens',
        'expire' => 60,
        'throttle' => 60,
    ],
],
```

---
> Modules\Consumer\Http\Controllers\Auth\RegisteredConsumerController.php

This Controller is used to handle registration, which will generate a new Consumer Model instead of a User Model. 

---
> Modules\Consumer\Http\Requests\Auth\LoginRequest.php

When the Consumer attempts to log in, `LoginRequest@authenticate` executes `Auth::guard('guard-name')->attempt($credentials)` which is the entry point for authenticated sessions.
You can find more details about Laravel Authentication [here](https://laravel.com/docs/authentication).

---
> Modules\Consumer\Http\Controller\Auth\...

Here you can find plenty of files copied from `app\Http\Controller\Auth\...` with a few changes here and there. I also added the Middlewares to `Kernel.php`, which is also worth reviewing.

## Appendix
Take this with a grain of salt, as you usually should do when cloning a git repository. I haven't invested time in validating API authentication, which would be an awesome addition to this repository. 

## Contributing

You are welcome to fork and contribute to this code :)


### Contact
[Linked In](https://de.linkedin.com/in/hussam-itani-31a156195)
[Web](https://it-ani.de/#contact)
