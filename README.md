You can test the endpoint in your postman with following links : 

- https://my-lyrics.000webhostapp.com/song/getallsongs 
- https://my-lyrics.000webhostapp.com/song/getsongbyartist/{your keyword, ex: noah}
- https://my-lyrics.000webhostapp.com/song/getsongbyalphabet/{your alphabet, ex: a}
- https://my-lyrics.000webhostapp.com/song/getsongbyid/{your id, ex: 122}
- https://my-lyrics.000webhostapp.com/song/getallartist
- https://my-lyrics.000webhostapp.com/song/getartistbyalphabet/{your keyword, ex: noah}
- https://my-lyrics.000webhostapp.com/song/search/{your keyword, ex: song's title or artist}
- https://my-lyrics.000webhostapp.com/song/create
  ex: 
  - judul : {your keyword}
  - penyanyi : {your keyword}
  - link : {your keyword}
  - lirik : {your keyword}
- https://my-lyrics.000webhostapp.com/song/update/{your song's id}
  ex:
  - judul : {your keyword}
  - penyanyi : {your keyword}
  - link : {your keyword}
  - lirik : {your keyword}
  
- https://my-lyrics.000webhostapp.com/song/delete/18746
  
  nb: for update and delete data set request method to POST , i've made mistake for it and will fix it soon :D

# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use Github issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
