#!/bin/bash
DIR=`dirname $(readlink -f $0)`
SALT_DIR='/srv/salt'
SSH_DIR='/home/ubuntu/.ssh'
SRV=$(hostname)
PILLAR_DIR='/srv/pillar'

. ${DIR}/main.sh

get_bootstrap(){
    wget -O - http://bootstrap.saltstack.org | sudo sh
}

minimum_pillar() {

 if [ ! -r ${PILLAR_DIR}database ] ; then

 mkdir ${PILLAR_DIR}/database
    #this creates the minimum salt pillar for local usage (random mysql password)
    echo "
dbuser: phminion
dbpass: $(randpass)" >  ${PILLAR_DIR}/database/init.sls

fi
}

copy_salt_files(){

    # copy master-only files
    if [[ ${SRV} == *master* ]] ; then
        echo ">>> Master server detected"
        echo
        sleep 2
        # make the salt-dirs
        if [ ! -r ${SALT_DIR} ] ; then
            mkdir ${SALT_DIR}
            mkdir ${SALT_DIR}/templates
            mkdir ${PILLAR_DIR}
        fi

        cp -R ${DIR}/salt/. ${SALT_DIR}/
        cp -R ${DIR}/salt/. ${SALT_DIR}/
        cp -R ${DIR}/templates/* ${SALT_DIR}/templates
        cp -R ${DIR}/salt/pillar/. ${PILLAR_DIR}

        # setup the minimum pillar information
        minimum_pillar
    fi
}

randpass() {
    echo `</dev/urandom tr -dc A-Za-z0-9 | head -c16`
}


# get salt
get_bootstrap

# copy the salt files
copy_salt_files


# run salt if this is the master
if [[ ${SRV} == *master* ]] ; then
    salt-call --local state.highstate -l debug
fi