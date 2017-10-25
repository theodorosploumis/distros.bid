## Build the base image

```
docker build -t drupal8/distros:latest images/latest
```

## Build a distro (eg lightning)

```
docker build -t drupal8/distros:lightning images/lightning
```

## How to add a new Distro

1. Create the {DISTRO} folder under images/ folder
2. Add a Dockerfile (drush vs composer installation)
3. Add {DISTRO} on tags7.txt or tags8.txt
4. Add {DISTRO} on index.php
5. Add {DISTRO} on main README.md
6. Add new {DISTRO} on the Docker hub build settings
7. Trigger image build (on docker hub)
8. Write down changes to use on a new RELEASE
