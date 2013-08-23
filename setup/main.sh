#!/bin/bash
DIR=`dirname $(readlink -f $0)`
MAIN_USER='ubuntu'

if [ ! -w /etc/hosts ] ; then
   echo "Please run this script as sudo!";
   exit;
fi

if [ ! -r /home/${MAIN_USER} ] ; then
    echo ">>> Main user home directory ${MAIN_USER} not found, please create the user and setup the proper keys."
    exit

fi

if [ -z $BASH ] ; then
    echo ">>> Invalid shell, please run bash <script> or ./<script> and not sh <script>"
    exit
fi