## Build the base image

```
docker build -t drupal8/distros:latest images/10x/latest
```

## Build a distro (eg lightning)

```
docker build -t drupal8/distros:drupal-umami-10x images/10x/drupal-umami
```

## Test the build
```
docker run -p 8066:80 --name drupal-umami-10x drupal8/distros:drupal-umami-10x
```

## Push the new images

```
docker push drupal8/distros:drupal-umami-10x
```

## How to add a new Distro

1. Create the {DISTRO} folder under images/ folder
2. Add a Dockerfile (drush vs composer installation)
3. Add {DISTRO} on tags7.txt or tags.txt
4. Add {DISTRO} on index.php
5. Add {DISTRO} on main README.md
6. Add new {DISTRO} on the Docker hub build settings
7. Trigger image build (on docker hub)
8. Write down changes to use on a new RELEASE
