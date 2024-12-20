#!/usr/bin/env bash
# Start all docker containers for testing from port 8041+

DOMAIN = "localhost"
DIR="$(dirname $0)"
VERSION=8x

cat images/$VERSION/tags.txt | while read line
do
  ID=$(echo "$line" | cut -c1-2)
  DISTRO=$(echo $line | sed -r 's/^.{3}//')

  if [ $line == "latest" ]; then
    TAG="latest"
  else
    TAG="$DISTRO-$VERSION"
  fi

  PORT=$((8040 + $ID))

  echo "Starting container for distro" $DISTRO on port $PORT;
  docker run -d -p $PORT:80 drupal8/distros:$DISTRO;
  google-chrome "http://$DOMAIN:$PORT";
done
