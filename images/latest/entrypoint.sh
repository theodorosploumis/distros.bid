#!/bin/sh

#/etc/init.d/mysql start
#/etc/init.d/apache2 start
#/usr/bin/mysqld_safe

chown -R mysql:mysql /var/lib/mysql /var/run/mysqld && service mysql start

/usr/sbin/apache2ctl start

tail -f /var/log/apache2/access.log
