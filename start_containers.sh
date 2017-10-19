#!/usr/bin/env bash
# Start all docker containers for testing

cat tags.txt | while read line
do
  ID=$(echo "$line" | cut -c1-2)
  DISTRO=$(echo $line | sed -r 's/^.{3}//')
  PORT=$((8040 + $ID))

  echo "Starting container for distro" $DISTRO on port $PORT;
  docker run -d -p $PORT:80 drupal8/distros:$DISTRO;
  google-chrome localhost:$PORT;
done
