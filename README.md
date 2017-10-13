# drupal-docker-distros
Showcase of Drupal distributions with Docker.

A list of Docker containers running several popular [Drupal 8.x distributions](https://www.drupal.org/project/project_distribution) within LAMP.

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
docker run -d -p 8066:80 --name {DISTRIBUTION_NAME} drupal8/distros:{DISTRIBUTION_NAME}
```

Open Drupal login page http://localhost:8066/user/login

- **User**: admin
- **Pass**: admin

Open Adminer page at http://localhost:8066/adminer.php

- **DB user**: drupal
- **DB name**: drupal
- **DB password**: drupal

## Distributions available

See the docker tags at [hub.docker.com/r/drupal8/distros/tags/](https://hub.docker.com/r/drupal8/distros/tags/)

| Name | Dockerfile | tag | version |
|---|---|---|---|
| Base | [images/base](images/base/dockerfile) | base | - |
| [Drupal](https://www.drupal.org/project/drupal) | [images/drupal](images/drupal/dockerfile) | drupal | 8.4.0 |
| [Lightning](https://www.drupal.org/project/lightning) | [images/lightning](images/lightning/dockerfile) | lightning | 8.x-2.2.0 |

## License

[GNU GPLV2](LICENSE)
