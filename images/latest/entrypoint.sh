#!/bin/sh

#/etc/init.d/mysql start
#/etc/init.d/apache2 start

chown -R mysql:mysql /var/lib/mysql /var/run/mysqld && /usr/bin/mysqld_safe

/usr/sbin/apache2ctl start

tail -f /var/log/apache2/access.log
