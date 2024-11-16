#!/usr/bin/env bash
# Pull all docker images of this repo

VERSION=10x

cat $DIR/../images/$VERSION/tags.txt | while read line
do
  echo "Pulling image" $line-$VERSION;
  docker pull drupal8/distros:$line-$VERSION;
done
