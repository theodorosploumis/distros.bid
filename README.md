# Drupal docker distributions
Showcase of Drupal distributions with Docker.


> Test it live at [distros.bid](http://distros.bid).

A list of Docker containers running several popular [Drupal 8.x distributions](https://www.drupal.org/project/project_distribution) within LAMP stack.

## Software per docker image

- adminer
- apache2
- composer
- curl
- drush
- mysql 5.5
- php 5.6
- supervisord
- vim
- wget


## Usage

Each Drupal distribution refers to a specific docker image tag.
Currently only 1 version is supported for each distribution and there no
version specific tags (eg there is "drupal" but not "drupal-8.4.0" tag). Notice that most images are of 1-1.5GB size so be patient while pulling.


```
# Let's try lightning distribution

docker run -d -p 8066:80 --name lightning drupal8/distros:lightning

```


Open Drupal login page http://localhost:8066/user/login

- **User**: admin
- **Pass**: admin

Open Adminer page at http://localhost:8066/adminer.php

- **DB username**: drupal
- **DB name**: drupal
- **DB password**: drupal

## Distributions available

See the docker tags at [hub.docker.com/r/drupal8/distros/tags](https://hub.docker.com/r/drupal8/distros/tags/).

| Name | Dockerfile | Tag | Version |
|---   |---         |---  |      ---|
| Base | [images/base](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/base/Dockerfile/) | base | - |
| [aGov](https://www.drupal.org/project/agov) | [images/agov](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/agov/Dockerfile/) | agov | 1.3 |
| [Bear](https://www.drupal.org/project/bear) | [images/bear](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/bear/Dockerfile/) | bear | 2.0-alpha3 |
| [Brainstorm](https://www.drupal.org/project/brainstorm_profile) | [images/brainstorm_profile](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/brainstorm_profile/Dockerfile/) | brainstorm | 1.0-beta2 |
| [Drupal](https://www.drupal.org/project/drupal) | [images/drupal](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/drupal/Dockerfile/) | drupal | 8.4.0 |
| [Druppio](https://www.drupal.org/project/druppio_small_business_distribution) | [images/druppio_small_business_distribution](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/druppio_small_business_distribution/Dockerfile/) | druppio | 1.14 |
| [Lightning](https://www.drupal.org/project/lightning) | [images/lightning](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/lightning/Dockerfile/) | lightning | 2.2.0 |
| [OpenChurch](https://www.drupal.org/project/openchurch) | [images/openchurch](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/openchurch/Dockerfile/) | openchurch | 2.0-rc11 |
| [Open Door](https://www.drupal.org/project/open_door) | [images/open_door](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/open_door/Dockerfile/) | opendoor | 1.0-beta2 |
| [OpenRestaurant](https://www.drupal.org/project/openrestaurant) | [images/openrestaurant](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/openrestaurant/Dockerfile/) | openrestaurant | 1.0-beta2 |
| [Open Social](https://www.drupal.org/project/social) | [images/social](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/social/Dockerfile/) | social | 1.5 |
| [Panopoly](https://www.drupal.org/project/panopoly) | [images/panopoly](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/panopoly/Dockerfile/) | panopoly | 2.0-alpha7 |
| [Presto](https://www.drupal.org/project/presto) | [images/presto](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/presto/Dockerfile/) | presto | 2.0-beta3 |
| [Thunder](https://www.drupal.org/project/thunder) | [images/thunder](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/thunder/Dockerfile/) | thunder | 2.9 |
| [Varbase](https://www.drupal.org/project/varbase) | [images/varbase](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/varbase/Dockerfile/) | varbase | 4.10 |
| [Vardoc](https://www.drupal.org/project/vardoc) | [images/vardoc](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/vardoc/Dockerfile/) | vardoc | 1.0-beta2 |

## License

[GNU GPLV2](LICENSE)
