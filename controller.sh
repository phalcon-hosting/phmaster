#!/bin/bash
echo "Phalcon Hosting - Controller script"
echo
DIR=`dirname $(readlink -f $0)`
SILENT=false
ROLE=false
MINION_IP=false
MINION_USER=false
MINION_PASS=false
BOOTSTRAP=false

. ${DIR}/setup/main.sh
. ${DIR}/setup/controller_functions.sh

helpopts() {
    echo 'Available options: '
    echo
    echo "-m [minion ip] target this minion"
    echo "-g [keyfile] generate a new ssh-key file used for minion authentication"
    echo "-u [minion user] minion ssh user"
    echo "-k [keyfile] set keyfile for authentication"
    echo "-b Bootstrap the targetted minion"
    echo "-r [database|memcache|webserver] - Assign a role"
    echo "-s run this script silent"
    echo "-w Update all the minions"
}

while getopts ":as-helpwbr:m:g:u:k:" opt; do
  case $opt in
    s)
      echo "Running in silent mode"
      SILENT=true
      ;;
    r)
      case $OPTARG in
        'webserver'|'memcache'|'database')
            test_minion
            ROLE=$OPTARG
            ;;
        *)
            echo
            echo '>>> Invalid role!'
            helpopts
            exit
            ;;
         esac
      ;;
      h|'-help')
        #show help
        helpopts
        exit
      ;;
      b)
        test_minion
        BOOTSTRAP=true
        echo "--- Bootstrappig minion on IP: ${MINION_IP} ---"
      ;;
      m)
        MINION_IP=$OPTARG
        echo ">>> Minion IP set: $OPTARG"
      ;;
      k)
        if [ ! -r $OPTARG  ] ; then
            KEYFILE=${DIR}/setup/ssh-key/$OPTARG
        else
            KEYFILE=$OPTARG
        fi
        echo ">>> Keyfile set: ${KEYFILE}"
      ;;
      u)
        MINION_USER=$OPTARG
        echo ">>> Minion User set: $OPTARG"
      ;;
      g)
        if [ ! $OPTARG ] ; then
            echo '>>> Usage: -g [keyfile] - Generates a new keypair'
            exit;
        fi
        generate_key $OPTARG
        exit
      ;;
      w)
        salt '*' state.highstate -v
        exit;
      ;;
    \?)
      echo "Invalid option: -$OPTARG" >&2
      ;;

  esac
done

check_keypair

echo
sleep 1

run_job