#!/usr/bin/env bash

function start_all() {
  # Execute configuration script
  /root/configure.py

  # Start services
  /etc/init.d/mysql start
  /etc/init.d/apache2 start
  cron

  # Expose a bash script for interactive mode
  /bin/bash
}

function reload_all() {
  echo "Reloading..."
  /etc/init.d/mysql restart
  /etc/init.d/apache2 restart
}

function stop_all() {
  echo "Shutting down..."
  /etc/init.d/mysql stop
  /etc/init.d/apache2 stop
}

trap stop_all EXIT
trap reload_all SIGHUP

start_all