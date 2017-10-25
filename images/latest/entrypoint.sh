#!/bin/sh

#/etc/init.d/mysql start
#/etc/init.d/apache2 start

/usr/sbin/apache2ctl start
/usr/bin/mysqld_safe

tail -f /dev/null
