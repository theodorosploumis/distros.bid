#!/usr/bin/env bash
# Build all docker images of this repo

DIR="$(dirname $0)"

cat $DIR/../tags7.txt | while read line
do
  ID=$(echo "$line" | cut -c1-2)
  DISTRO=$(echo $line | sed -r 's/^.{3}//')

  echo "$ID. Building image" $DISTRO;
  docker build -t drupal8/distros:$DISTRO https://github.com/theodorosploumis/drupal-docker-distros.git#:images/$DISTRO;
done
