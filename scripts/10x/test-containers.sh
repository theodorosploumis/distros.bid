#!/usr/bin/env bash
# Start all docker containers for testing from port 8041+

DOMAIN="localhost"
DIR="$(dirname $0)"
VERSION=10x
INDEX=1

cat ${DIR}/../../images/$VERSION/tags.txt | while read line
do
  INDEX=$INDEX+1
  if [ $line == "latest" ]; then
    TAG="latest"
  else
    TAG="$line-$VERSION"
  fi
  PORT=$((8090 + $INDEX))

  echo "Starting container for distro" $TAG on port $PORT;
  docker run -d -p $PORT:80 drupal8/distros:$TAG;
  google-chrome "http://$DOMAIN:$PORT";
done
