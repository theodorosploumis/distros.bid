#!/usr/bin/env bash
# Pull all docker images of this repo

cat $DIR/../tags8.txt | while read line
do
  ID=$(echo "$line" | cut -c1-2)
  DISTRO=$(echo $line | sed -r 's/^.{3}//')

  echo "$ID. Pulling image" $DISTRO;
  docker pull drupal8/distros:$DISTRO;
done
