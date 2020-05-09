#!/usr/bin/env bash
# Build all docker images of this repo

DIR="$(dirname $0)"

cat $DIR/../tags.txt | while read line
do
  echo "Building image" $line;
  docker build -t drupal8/distros:$line https://github.com/theodorosploumis/drupal-docker-distros.git#:images/$line;
done
