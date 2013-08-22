#!/bin/bash
DIR=`dirname $(readlink -f $0)`
SALT_DIR='srv/salt'
SSH_DIR='/home/ubuntu/.ssh'

source ${DIR}/setup/main_checks.sh

get_bootstrap(){
    wget -O - http://bootstrap.saltstack.org | sudo sh
}

copy_salt_files(){

    # copy the ssh keys
    if [ ! -r ${SSH_DIR} ] ; then
       mkdir ${SSH_DIR}
       cp -R ${DIR}/ssh-key/. ${SSH_DIR}
    fi


    # copy master-only files
    if [ -r /etc/salt/master ] ; then

        # make the salt-dirs
        if [ ! -r ${SALT_DIR} ] ; then
            mkdir ${SALT_DIR}
            mkdir ${SALT_DIR}/templates
            mkdir ${SALT_DIR}/pillar
        fi

        cp -R ${DIR}/salt/. ${SALT_DIR}/
        cp -R ${DIR}/salt/. ${SALT_DIR}/
        cp -R ${DIR}/templates/* ${SALT_DIR}/templates
        cp -R ${DIR}/pillar/* ${SALT_DIR}/pillar
    fi
}

randpass() {
    echo `</dev/urandom tr -dc A-Za-z0-9 | head -c16`
}

minimum_pillar() {

 if [ ! -r ${SALT_DIR}/pillar/database ] ; then

 mkdir ${SALT_DIR}/pillar/database
    #this creates the minimum salt pillar for local usage (random mysql password)
    echo "
dbuser: phminion
dbpass: $(randpass)" > ${SALT_DIR}/pillar/database/init.sls

fi
}
# get salt
get_bootstrap

# copy the salt files
copy_salt_files

# setup the minimum pillar information
minimum_pillar

# run salt
salt-call --local state.highstate -l debug