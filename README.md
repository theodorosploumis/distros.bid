# drupal-docker-distros
Showcase of Drupal distributions with Docker.

A list of Docker containers running several popular [Drupal 8.x distributions](https://www.drupal.org/project/project_distribution) within LAMP stack.

## Software per docker image
- apache2
- php 5.6
- mysql 5.5
- supervisord
- composer
- drush
- wget, curl, vim
- adminer

## Usage

Each Drupal distribution refers to a specific docker image tag.
Currently only 1 version is supported for each distribution and there no
version specific tags (eg there is "drupal" but not "drupal-8.4.0" tag).

```
# Lat's try lightning distribution
docker run -d -p 8066:80 --name lightning drupal8/distros:lightning
```

Open Drupal login page http://localhost:8066/user/login

- **User**: admin
- **Pass**: admin

Open Adminer page at http://localhost:8066/adminer.php

- **DB user**: drupal
- **DB name**: drupal
- **DB password**: drupal

## Distributions available

See the docker tags at [hub.docker.com/r/drupal8/distros/tags](https://hub.docker.com/r/drupal8/distros/tags/).

| Name | Dockerfile | Tag | Version |
|---   |---         |---  |      ---|
| Base | [images/base](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/base/Dockerfile/) | base | - |
| [Drupal](https://www.drupal.org/project/drupal) | [images/drupal](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/drupal/Dockerfile/) | drupal | 8.4.0 |
| [Lightning](https://www.drupal.org/project/lightning) | [images/lightning](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/lightning/Dockerfile/) | lightning | 2.2.0 |
| [Thunder](https://www.drupal.org/project/thunder) | [images/thunder](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/thunder/Dockerfile/) | thunder | 2.9 |
| [Varbase](https://www.drupal.org/project/varbase) | [images/varbase](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/varbase/Dockerfile/) | varbase | 4.10 |
| [Open Social](https://www.drupal.org/project/social) | [images/social](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/social/Dockerfile/) | social | 1.5 |

## License

[GNU GPLV2](LICENSE)
