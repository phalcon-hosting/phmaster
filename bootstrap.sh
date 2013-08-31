#!/bin/bash
DIR=`dirname $(readlink -f $0)`
. ${DIR}/setup/main.sh

KEYFILE=/home/${MAIN_USER}/.ssh/id_rsa

bootstrap() {
    if [ ! -r ${KEYFILE} ] ; then

        mkdir /home/${MAIN_USER}/.ssh
        if [ ! -r /etc/ssh/ssh_known_hosts ] ; then
            ssh-keyscan -H github.com > /etc/ssh/ssh_known_hosts
        fi

        # if the id_rsa does exists, create one
        echo -e "\n\n\n" | ssh-keygen -t rsa -N "" -f ${KEYFILE}
    fi
}
if [ ! -w /etc/hosts ] ; then
   echo "Please run this script as sudo!";
   exit;
fi

# run the initial bootstrapping
bootstrap

echo ">>> Bootstrapping Phalcon Hosting server"
sleep 1

# bootstrap salt
sudo bash ${DIR}/setup/salt.sh