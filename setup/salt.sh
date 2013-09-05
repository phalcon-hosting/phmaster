#!/bin/bash
DIR=`dirname $(readlink -f $0)`
SALT_DIR='/srv/salt'
HOME_DIR=/home/ubuntu
SSH_DIR="${HOME_DIR}/.ssh"
PILLAR_DIR='/srv/pillar'
OWN_HOST=$(hostname --fqdn)

if [ ${FORCE_MASTER} = true ] ; then
    OWN_HOST='masterforced'
fi

randpass() {
    echo `</dev/urandom tr -dc A-Za-z0-9 | head -c16`
}

randhash() {
    echo `</dev/urandom tr -dc A-Za-z0-9\.\~\& | head -c32`
}

DB_PILLAR=${PILLAR_DIR}/database.sls
ROOT_PASS=$(randpass)
TEST_PASS=$(randpass)
BLOWFISH_HASH=$(randhash)

. ${DIR}/main.sh

get_bootstrap(){
    if [[ ${OWN_HOST} == *master* ]] ; then
        if [ ! -r /etc/salt ] ; then
            sudo mkdir /etc/salt
        fi

        sudo cp ${DIR}/templates/minion.conf /etc/salt/minion
        sudo sed -i -e 's/#master: salt/master: localhost/g' /etc/salt/minion
    fi

    wget -O - http://bootstrap.saltstack.org | sudo sh


}

minimum_pillar() {

 if [ ! -r ${DB_PILLAR} ] ; then

    #this creates the minimum salt pillar for local usage (random mysql password)
    echo "
root_password: ${ROOT_PASS}
test_password: ${TEST_PASS}
blowfish_hash: ${BLOWFISH_HASH}" >  ${DB_PILLAR}

sudo sed -i -e "s/\:TEST_PASS/'${TEST_PASS}'/g" ${PILLAR_DIR}/database_users.sls

fi
}

copy_salt_files(){

    # copy master-only files
    if [[ ${OWN_HOST} == *master* ]] ; then
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
        cp -R ${DIR}/ph/. ${SALT_DIR}/ph
        cp -R ${DIR}/salt/. ${SALT_DIR}/
        cp -R ${DIR}/templates/* ${SALT_DIR}/templates
        cp -R ${DIR}/pillar/. ${PILLAR_DIR}

        # setup the minimum pillar information
        minimum_pillar
    fi

}



# get salt
get_bootstrap

# copy the salt files
copy_salt_files


# run salt if this is the master
if [[ ${OWN_HOST} == *master* ]] ; then
    salt-call --local state.highstate -l debug

    salt-key -a ${OWN_HOST} -y
    echo
    echo '>>> Master server successfully bootstraped!'
fi