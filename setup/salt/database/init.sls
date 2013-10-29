include:
  - webserver

mariadb_repo:
  pkgrepo:
    - managed
    - keyid: '0xcbcb082a1bb943db'
    - keyserver: keyserver.ubuntu.com
    - name: deb http://mirrors.supportex.net/mariadb/repo/5.5/ubuntu precise main

/etc/mysql/my.cnf:
  file:
    - managed
    - source: salt://templates/database/my.cnf
    - mode: 644
    - makedirs: True

# preset the root password for mariab
mariadb-root-debconf:
  debconf.set:
    - name: mariadb-server
    - data:
        mysql-server/root_password: {'type': 'password', 'value': {{ pillar["root_password"] }} }
        mysql-server/root_password_again: {'type': 'password', 'value': {{ pillar["root_password"] }} }


mariadb-server:
  pkg:
    - installed
    - require:
      - pkgrepo: mariadb_repo
      - file: /etc/mysql/my.cnf
      - debconf.set: mariadb-server
  service:
   - name: mysql
   - running
   - enable: True
   - reload: True
   - require:
      - pkg: mariadb-server
      - file: /etc/mysql/my.cnf