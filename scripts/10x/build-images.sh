#!/usr/bin/env bash
# Build docker images of this repo for current version

VERSION=10x

cat ../../images/${VERSION}/tags.txt | while read line
#do
#  echo "Building image" $line;
#  docker build -t drupal8/distros:$line-$VERSION https://github.com/theodorosploumis/drupal-docker-distros.git#:images/$VERSION/$line;
#done

do
  if [ $line == "latest" ]; then
  	TAG="latest"
  else
    TAG="$line-$VERSION"
  fi
  echo "Building image" $TAG;
  docker build -t drupal8/distros:$TAG images/$VERSION/$line;
done
