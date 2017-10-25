#!/bin/sh

#/etc/init.d/mysql start
#/etc/init.d/apache2 start

/usr/sbin/apache2ctl start

chown -R mysql:mysql /var/lib/mysql /var/run/mysqld && /usr/bin/mysqld_safe

tail -f /dev/null
