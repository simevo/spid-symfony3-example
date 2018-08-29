# spid-symfony3-example

Example Symfony3 project based on [spid-symfony-bundle](https://github.com/italia/spid-symfony-bundle) to demonstrate how to integrate SPID login.

[SPID](https://www.spid.gov.it/) is the Italian digital identity system, which enables citizens to access all public services with a single set of credentials.

The project [was created](https://symfony.com/doc/3.4/setup.html) with:

```sh
php symfony.phar new spid-symfony3-example 3.4
```

## Getting Started

Tested on: amd64 Debian 9.5 (stretch, current stable) with PHP 7.0.

### Prerequisites

```
sudo apt install php-cli composer
```

### Configuring and Installing

Install dependencies with composer:

```sh
composer install
```

Configure your application in `app/config/parameters.yml` file.

### Demo

Run your application:

  1. Execute the `php bin/console server:start` command.
  2. Browse to the http://localhost:8000 URL.

## License

Copyright (c) 2018, simevo s.r.l.

License: BSD 3-Clause, see [LICENSE](LICENSE) file.
