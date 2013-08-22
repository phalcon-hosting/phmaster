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

source ${DIR}/setup/controller_functions.sh
source ${DIR}/setup/main_checks.sh



helpopts() {
    echo 'Available options: '
    echo
    echo "-m [minion ip] target this minion"
    echo "-g [keyfile] generate a new ssh-key file used for minion authentication"
    echo "-u [minion user] minion ssh user"
    echo "-p [minion password] minion ssh password"
    echo "-b Bootstrap the targetted minion"
    echo "-r [database|memcache|webserver] - Assign a role"
    echo "-s run this script silent"
}

while getopts ":as-helpr:m:g:" opt; do
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
      ;;
      m)
        MINION_IP=$OPTARG
      ;;
      p)
        MINION_PASS=$OPTARG
      ;;
      u)
        MINION_USER=$OPTARG
      ;;
      g)
        generate_key $OPTARG
        exit
      ;;
    \?)
      echo "Invalid option: -$OPTARG" >&2
      ;;

  esac
done



echo
sleep 1

run_job