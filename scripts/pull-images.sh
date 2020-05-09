#!/usr/bin/env bash
# Pull all docker images of this repo

cat $DIR/../tags.txt | while read line
do
  echo "Pulling image" $line;
  docker pull drupal8/distros:$line;
done
