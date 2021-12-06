#!/usr/bin/env bash
# Build all docker images of this repo

cat ../tags.txt | while read line
do
  echo "Building image" $line;
  docker build -t drupal8/distros:$line https://github.com/theodorosploumis/drupal-docker-distros.git#:images/$line;
done
