# Web Application for Employee Task Assignment and Tracking

## About Application

###### [ENG]

The app is done as a university project. The goal was to make an MVC (Model-View-Controller) application for employee
task assignment and tracking. The app is fully written in Serbian language.

Technologies used: PHP (Laravel, Blade), MySQL, AJAX, HTML, CSS.

There are four types of roles - Guest, Executor, Manager and Administrator.

**Guest** has the ability to:
- visit homepage
- register (with e-mail confirmation)
- login
- reset password

**Executor** has the ability to:
- view the list of their assigned tasks
- mark tasks as complete
- leave a comment and delete a comment created by them
- filter and sort tasks by date, executors and managers

**Manager** has the ability to:
- create, edit and delete tasks
- create, edit and delete task group (to which he has access)
- mark tasks as complete or cancelled
- leave a comment and delete a comment created by them or any user with executor role in tasks from their task group
- filter and sort tasks by date, priority, executors and name

**Administrator** has the ability to:
- list, create, edit and delete users
- list, create, edit and delete types of users
- list, create, edit and delete tasks
- list, create, edit and delete task group
- list all, create, edit and delete any comment
- mark tasks as complete or cancelled

To quickly login, please see the credentials in the file **pass.txt**. 

###### [SRB]

Aplikacija je kreirana kao projekat za predmet na osnovnim studijama. Glavni cilj bio je da se implementira MVC 
(Model-View-Controller) arhitektura u aplikaciju za postavljanje i realizaciju radnih zadataka zaposlenih.
Aplikacija je napisana na srpskom jeziku.

Upotrebljene tehnologije: PHP (Laravel, Blade), MySQL, AJAX, HTML, CSS.

Postoje četiri tipa korisnika: Gost, Izvršilac, Rukovodilac odeljenja i Administrator.

**Gost** ima mogućnost da:
- poseti početnu stranicu
- registruje se (uz potvrdu putem e-mail-a)
- prijavi se
- promeni lozinku

**Izvršilac** ima mogućnost da:
- pogleda listu dodeljenih zadataka
- označi zadatak kao završen
- ostavi komentar ili obriše svoj komentar
- filtrira i sortira po datumu, izvršiocima i rukovodiocima odeljenja

**Rukovodilac odeljenja** ima mogućnost da:
- pravi, izmenjuje i briše zadatke (kojima ima pristup)
- pravi, izmenjuje i briše grupe zadataka (kojima ima pristup)
- označi zadatak kao završen ili otkazan
- ostavi komentar ili izvbriše komentar koji je kreirao on ili izvršilac, unutar zadatka kojem rukvodilac ima pristup
- filtrira i sortira po datumu, prioritetu, izvršiocima i imenu

**Administrator** ima mogućnost da upravlja celom aplikacijom, odnosno da:
- izlistava, pravi, izmenjuje i briše korisnike
- izlistava, pravi, izmenjuje i briše tipove korisnika
- izlistava, pravi, izmenjuje i briše zadatke
- izlistava, pravi, izmenjuje i briše grupe zadataka 
- izlistava, pravi, izmenjuje i komentare
- označi zadatak kao završen ili otkazan

Za brzu prijavu, molimo unesite podatke iz fajla **pass.txt**.

________________________________________________________________________________________________________________________

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and
creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in
many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache)
  storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all
modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a
modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video
tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging
into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in
becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in
the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by
the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell
via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
