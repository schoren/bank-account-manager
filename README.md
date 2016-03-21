This code is the result of an experiment/blog post in my [personal blog](http://schoren.me/)

It is an experiment to develop a frameworkless framework where:

1. Code is clean and simple.
2. Code is lightway and runs very, very fast (and is easy on the resources. I want to scale).
3. Code should be very easy to test in any layer. Even better if I can finally do Test Driven Development.
4. It allows me to do anything I want in the way I want it.

Setup
=====

You need to have `composer` installed, and PHP >= 5.4. With that installed, you can install dependecies:

```bash
composer install
```

To run the tests:

```bash
bin/phpspec run
```
