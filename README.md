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

## Distributions available tags

- [Base](#)
- [Drupal](#)
- [Lightning](#)

## License

[GNU GPLV2](LICENSE)
