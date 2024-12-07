# Drupal docker distributions

[![Docker pulls](https://img.shields.io/docker/pulls/drupal8/distros.svg)](https://hub.docker.com/r/drupal8/distros) 

## About

An easy online service to spin Drupal Distribution instances in seconds. 
Behind the scens this project maintains a list of Docker containers running several popular [Drupal 10.x, 8.x and 7.x distributions](http://dgo.to/project_distribution) within LAMP stack.

## Try online

Go to [distros.bid](http://distros.bid/?utm_source=github&utm_medium=browser&utm_campaign=github_repo).

## Distributions available

See the docker tags at [hub.docker.com/r/drupal8/distros/tags](https://hub.docker.com/r/drupal8/distros/tags/).

### Drupal 10.x

- Drupal (core) - 10.3.8
- Drupal Umami (core) - 10.3.8
- Open Social - 12.4.5
- Drutopia - 1.18
- Opigno LMS - 3.2.7
- OpenLucius - 2.0.0-beta1

### Drupal 8.x

| Name | Dockerfile | Tag                                 |
|:---  |:---------- |:------------------------------------|
| Latest | [images/latest](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/latest/Dockerfile/) | latest                              |
| [aGov](http://dgo.to/agov) | [images/agov](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/agov/Dockerfile/) | agov                                |
| [Brainstorm](http://dgo.to/brainstorm_profile) | [images/brainstorm_profile](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/brainstorm_profile/Dockerfile/) | brainstorm_profile                  |
| [Droopler](http://dgo.to/droopler) | [images/droopler](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/droopler/Dockerfile/) | droopler                            |
| [Drupal 8.x](http://dgo.to/drupal) | [images/drupal](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/drupal/Dockerfile/) | drupal                              |
| [Drupal Umami](http://dgo.to/drupal) | [images/drupal-umami](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/drupal-umami/Dockerfile/) | drupal-umami                        |
| [Druppio](http://dgo.to/druppio_small_business_distribution) | [images/druppio_...](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/druppio_small_business_distribution/Dockerfile/) | druppio_small_business_distribution |
| [Lightning](http://dgo.to/lightning) | [images/lightning](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/lightning/Dockerfile/) | lightning                           | 8.x-3.100 |
| [Multipurpose Corporate](http://dgo.to/multipurpose_corporate_profile) | [images/multipurpose_...](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/multipurpose_corporate_profile/Dockerfile/) | multipurpose_corporate_profile      |
| [OpenChurch](http://dgo.to/openchurch) | [images/openchurch](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/openchurch/Dockerfile/) | openchurch                          |
| [OpenRestaurant](http://dgo.to/openrestaurant) | [images/openrestaurant](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/openrestaurant/Dockerfile/) | openrestaurant                      |
| [Panopoly](http://dgo.to/panopoly) | [images/panopoly](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/panopoly/Dockerfile/) | panopoly                            |
| [Presto](http://dgo.to/presto) | [images/presto](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/presto/Dockerfile/) | presto                              |
| [Seeds](http://dgo.to/seeds) | [images/seeds](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/seeds/Dockerfile/) | seeds                               |
| [Thunder](http://dgo.to/thunder) | [images/thunder](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/thunder/Dockerfile/) | thunder                             |
| [Varbase](http://dgo.to/varbase) | [images/varbase](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/varbase/Dockerfile/) | varbase                             |
| [Vardoc](http://dgo.to/vardoc) | [images/vardoc](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/vardoc/Dockerfile/) | vardoc                              |
| [Web Experience Toolkit](http://dgo.to/wxt) | [images/wxt](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/images/wxt/Dockerfile/) | wxt                                 |

## Software per docker image

| Software    | Version |
|:------------|:------|
| sqliteadmin | 4.3.1 |
| **apache2** | 2.4.18 |
| composer    | 1.9.2 or 2.8.2 |
| curl        | 7.47.0 |
| **drush**   | 10.2.2 |
| git         | 2.7.4 |
| **php**     | 7.2 or 8.4 |
| vi          | 7.4   |
| wget        | 1.17.1 |

## Usage

Each Drupal distribution refers to a specific docker image tag.
Currently only 1 version is supported for each distribution and there no
version specific tags (eg there is "drupal" but not "drupal-8.4.2" tag). Notice that most images are of 1 - 2GB size so be patient while pulling.


```
# Let's try lightning distribution

docker run -d -p 8066:80 --name lightning drupal8/distros:lightning

```


Open Drupal user login page at http://localhost:8066/user/login

- **User**: admin
- **Pass**: admin

Open Adminer page at http://localhost:8066/adminer.php

- **DB username**: drupal
- **DB name**: drupal
- **DB password**: drupal

Open Terminal emulator at http://localhost:8066/terminal.php

- **User**: www-data
- **Password**: password

Notice that www-data user has only sufficient permissions under the /web folder and no sudo exists.

## License

[![license](https://img.shields.io/github/license/theodorosploumis/drupal-docker-distros.svg)](https://github.com/theodorosploumis/drupal-docker-distros/blob/master/LICENSE)
