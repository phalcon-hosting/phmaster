#!/bin/bash


assign_role() {

    echo "ASSIGNING ROLE ${ROLE}..."
    salt-call --local grains.setval role ${ROLE}

    # run salt again with the new role
    salt-call --local state.highstate -l debug
}

test_minion() {
    MINION_IP=$1

    if [ MINION_USER = false ] || [ MINION_PASS = false ] ; then
        echo '>>> When targetting a minion, please specify a user/password with -u and -p '
        exit
    fi

}

run_boostrap() {
    echo
}

generate_key() {
    ORIG_KEYFILE=${DIR}/setup/ssh-key/${1}
    KEYFILE=${DIR}/setup/ssh-key/${1}.pem
    echo "--- Generating new SSH keypair ${1}.pem ---"
    sleep 1

    ssh-keygen -t dsa -b 1024
    echo -e "\n\n\n" | ssh-keygen -t dsa -N "" -f ${ORIG_KEYFILE}
    openssl dsa -in ${ORIG_KEYFILE} -outform pem > ${KEYFILE}

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