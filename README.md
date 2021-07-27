<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Cubet Techno Labs](https://cubettech.com)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[Many](https://www.many.co.uk)**
-   **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
-   **[DevSquad](https://devsquad.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### API LINK

|Method| URI Name| Action| Middleware|
<<<<<<< HEAD
|--------|---------|--------|-----------|
|GET/HEAD| /index| App\Http\Controllers\UserController@index| web|
=======
|------|----------|------|--------------|
|GET|HEAD| /index| App\Http\Controllers\UserController@index| web|
>>>>>>> 92d5a90a0a273e26be2b9b3a461b80f435121cc5
|POST |api/auth/login |App\Http\Controllers\AuthController@login| api|
|POST| api/auth/logout| App\Http\Controllers\AuthController@logout| api|
auth:api
GET|HEAD api/auth/profile App\Http\Controllers\AuthController@profile api
auth:api
POST api/auth/refresh App\Http\Controllers\AuthController@refresh api
auth:api
POST api/auth/register App\Http\Controllers\AuthController@register api
GET|HEAD api/commentbyid App\Http\Controllers\ComentsController@commentbyid api
auth:api
GET|HEAD api/comments comments.index App\Http\Controllers\ComentsController@index api
auth:api
POST api/comments comments.store App\Http\Controllers\ComentsController@store api
auth:api
GET|HEAD api/comments/create comments.create App\Http\Controllers\ComentsController@create api
auth:api
DELETE api/comments/{comment} comments.destroy App\Http\Controllers\ComentsController@destroy api
auth:api
PUT|PATCH api/comments/{comment} comments.update App\Http\Controllers\ComentsController@update api
auth:api
GET|HEAD api/comments/{comment} comments.show App\Http\Controllers\ComentsController@show api
auth:api
GET|HEAD api/comments/{comment}/edit comments.edit App\Http\Controllers\ComentsController@edit api
auth:api
POST api/like like.store App\Http\Controllers\LikeController@store api
auth:api
GET|HEAD api/like like.index App\Http\Controllers\LikeController@index api
auth:api
GET|HEAD api/like/create like.create App\Http\Controllers\LikeController@create api
auth:api
PUT|PATCH api/like/{like} like.update App\Http\Controllers\LikeController@update api
auth:api
DELETE api/like/{like} like.destroy App\Http\Controllers\LikeController@destroy api
auth:api
GET|HEAD api/like/{like} like.show App\Http\Controllers\LikeController@show api
auth:api
GET|HEAD api/like/{like}/edit like.edit App\Http\Controllers\LikeController@edit api
auth:api
GET|HEAD api/posts posts.index App\Http\Controllers\PostsController@index api
auth:api
POST api/posts posts.store App\Http\Controllers\PostsController@store api
auth:api
GET|HEAD api/posts/create posts.create App\Http\Controllers\PostsController@create api
auth:api
DELETE api/posts/{post} posts.destroy App\Http\Controllers\PostsController@destroy api
auth:api
PUT|PATCH api/posts/{post} posts.update App\Http\Controllers\PostsController@update api
auth:api
GET|HEAD api/posts/{post} posts.show App\Http\Controllers\PostsController@show api
auth:api
GET|HEAD api/posts/{post}/edit posts.edit App\Http\Controllers\PostsController@edit api
auth:api
GET|HEAD index index2 App\Http\Controllers\UserController@index web
GET|HEAD login login App\Http\Controllers\UserController@login web
GET|HEAD logout logout App\Http\Controllers\UserController@logout web
GET|HEAD profile profile App\Http\Controllers\UserController@profile web
GET|HEAD refresh refresh App\Http\Controllers\UserController@refresh web
GET|HEAD register register App\Http\Controllers\UserController@register web
