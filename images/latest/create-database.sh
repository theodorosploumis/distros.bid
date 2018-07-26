#!/usr/bin/env bash
# /usr/bin/mysqld_safe > /dev/null 2>&1 &
# PID=$!
# RET=1

# while [[ $RET -ne 0 ]]; do
#     echo "=> Waiting for confirmation of MySQL service startup"
#     sleep 5
#     mysql -u root -e "status" > /dev/null 2>&1
#     RET=$?
# done

# echo "=> Started with PID ${PID}"

mysql -u root -e "CREATE DATABASE drupal CHARACTER SET utf8 COLLATE utf8_general_ci" && \
mysql -u root -e "GRANT ALL ON drupal.* to 'drupal' identified by 'drupal';"

echo "=> Done!"
