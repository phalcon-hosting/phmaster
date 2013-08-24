#!/bin/bash
MASTER_IP=false
if [ -r /etc/salt/master ] ; then
    MASTER_IP=`ifconfig | sed -En 's/127.0.0.1//;s/.*inet (addr:)?(([0-9]*\.){3}[0-9]*).*/\2/p'`
fi

assign_role() {
    MINION_HOST=$(remote_command "cat /etc/hostname")

    if [ ! -r "/etc/salt/pki/master/minions/${MINION_HOST}" ] ; then
        echo '>>> Action invalid, minion not available or not yet bootstrapped.'
        exit;
    fi
    echo ">>> Assigning role ${ROLE}..."
    echo

    remote_command "sudo salt-call --local grains.setval role ${ROLE}"

    # run salt again with the new role
    update_remote
}

test_minion() {
    echo
    if [ ${MINION_USER} = false ] || [ ${KEYFILE} = false ] ; then
        echo '>>> When targetting a minion, please specify a user and keyfile with -u and -k '
        exit
    fi

    if [ ! -r ${KEYFILE} ] ; then
        echo "Cannot read keyfile ${KEYFILE}"
    fi
    echo ">>> Attempting to connect to minion on: ${MINION_IP}"
    AUTH="${MINION_USER}@${MINION_IP} -i ${KEYFILE}"
    result=$(ssh -q -o BatchMode=yes -o ConnectTimeout=5 -o 'StrictHostKeyChecking no' ${AUTH} echo ok 2>&1)

    if [[ ! ${result} == *ok* ]] ; then
        echo ">>> Could not connect to ${MINION_IP}, please check given credentials"
        exit
    fi
    echo
    echo ">>> Successfully connected to minion on: ${MINION_IP}"
    sleep 1
    echo
}

run_bootstrap() {
    echo
    MINION_SETUP_DIR="/home/${MINION_USER}/minion-bootstrap"

    MINION_HOST=$(remote_command "cat /etc/hostname")
    if [ -r "/etc/salt/pki/master/minions/${MINION_HOST}" ] ; then
        echo ">>> This minion has already been bootstrapped! To re-bootstrap, run sudo salt-key -d '${MINION_HOST}'."
        exit;
    fi
    echo ">>> Uploading bootstrap files..."

    remote_command "mkdir ${MINION_SETUP_DIR}"
    remote_command "sudo mkdir /etc/salt"
    remote_copy "${DIR}/bootstrap.sh" "${MINION_SETUP_DIR}/bootstrap.sh"
    remote_copy "${DIR}/setup" "${MINION_SETUP_DIR}/setup"

    remote_command "sudo cp ${MINION_SETUP_DIR}/setup/templates/minion.conf /etc/salt/minion"
    remote_command "sudo sed -i -e 's/#master: salt/master: ${MASTER_IP}/g' /etc/salt/minion"
    remote_command "sudo ${MINION_SETUP_DIR}/bootstrap.sh"

    echo
    echo '--- Minion bootstrap complete ---'
    echo
    echo '>>> Trying to auto-accept new minion...'
    sleep 1
    echo
    salt-key -a ${MINION_HOST} -y
    echo
    echo '>>> Trying to update new minion, this could take a while...'
    sleep 10
    update_remote

}

update_remote() {
    update_cmd="salt '"${MINION_HOST}"' state.highstate -v"
    eval $update_cmd

}
remote_command() {
    CMD=${1}

    if [[ -z "$AUTH" ]] ; then
        echo '>>> Invalid usage of remote_command'
        exit
    fi

    ssh -o ConnectTimeout=5 -o 'StrictHostKeyChecking no' ${AUTH} ${CMD}
}

remote_copy() {
    if [[ -z "$AUTH" ]] ; then
        echo '>>> Invalid usage of remote_copy'
        exit
    fi

    if [[ -z "$1" ]] || [[ -z "$2" ]] ; then
        echo '>>> usage: remote_copy [source] [desination]'
        exit
    fi

    scp -r -i ${KEYFILE} ${1} ${MINION_USER}@${MINION_IP}:${2}
}
generate_key() {
    ORIG_KEYFILE=${DIR}/setup/ssh-key/${1}
    KEYFILE=${DIR}/setup/ssh-key/${1}
    echo "--- Generating new SSH keypair ${1} ---"
    sleep 1

    echo -e "\n\n\n" | ssh-keygen -t rsa -N "" -f ${KEYFILE}

    # secure the private keyfile
    chmod 600 ${KEYFILE}

    echo "--- Succesfully generated keyfile ---"
    exit;

}

run_job() {
    if [ ! ${ROLE} = false ] ; then
        assign_role
    elif [ ! ${BOOTSTRAP} = false ] ; then
        run_bootstrap
    else
        helpopts
        exit
    fi

}

check_keypair() {
    KEYDIR=${DIR}/setup/ssh-key/*
    for f in ${KEYDIR}
    do
        if [ `ssh-keygen -l -f  ${f} 2>/dev/null | wc -l` = 0 ] ; then
        echo '>>> No valid or invalid keyfile(s) found in setup/ssh-key. Please run controller.sh -g [keyfile]'
        exit
    fi
    done
}