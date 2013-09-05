#!/bin/bash
DIR=`dirname $(readlink -f $0)`
. ${DIR}/setup/main.sh
PH_DIR=/usr/local/ph

KEYFILE=/home/${MAIN_USER}/.ssh/id_rsa

export FORCE_MASTER=false

if [ $1 = '-f' ] ; then
    echo '>>> Forcing master mode'
    export FORCE_MASTER=true
fi

bootstrap() {
    . /etc/lsb-release

    if [ ! $DISTRIB_ID = 'Ubuntu' ] ; then
        echo ">>> This bootstrapper has been made for Ubuntu linux distributions"
        exit
    fi

    if [ ! -r ${KEYFILE} ] ; then

        mkdir /home/${MAIN_USER}/.ssh
        if [ ! -r /etc/ssh/ssh_known_hosts ] ; then
            ssh-keyscan -H github.com > /etc/ssh/ssh_known_hosts
        fi

        # if the id_rsa does exists, create one
        echo -e "\n\n\n" | ssh-keygen -t rsa -N "" -f ${KEYFILE}
    fi

    if [ ! -r ${PH_DIR} ] ; then
        mkdir ${PH_DIR}
    fi

    if grep -Fxq "${PH_DIR}" /etc/environment
    then
        echo ">>> Environment not updated"
    else
        echo "PH_DIR=${PH_DIR}" >> /etc/environment
        source /etc/environment
        echo ">>> Environment updated"
    fi

}
if [ ! -w /etc/hosts ] ; then
   echo "Please run this script as sudo!"
   exit
fi

# run the initial bootstrapping
bootstrap

echo ">>> Bootstrapping Phalcon Hosting server"
sleep 1

# bootstrap salt
sudo bash ${DIR}/setup/salt.sh