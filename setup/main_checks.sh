#!/bin/bash
DIR=`dirname $(readlink -f $0)`

if [ ! -w /etc/hosts ] ; then
   echo "Please run this script as sudo!";
   exit;
fi

if [ `ls -1 ${DIR}/setup/ssh-key/*.pem 2>/dev/null | wc -l` = 0 ] ; then
    echo '>>> No valid keyfile found in setup/ssh-key. Please run controller.sh -g'
    exit
fi