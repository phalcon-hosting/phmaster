include:
  - webserver

mariadb_repo:
  pkgrepo:
    - managed
    - keyid: '0xcbcb082a1bb943db'
    - keyserver: keyserver.ubuntu.com
    - name: deb http://repo.maxindo.net.id/mariadb/repo/5.5/ubuntu precise main

/etc/mysql/my.cnf:
  file:
    - managed
    - source: salt://templates/database/my.cnf
    - mode: 644
    - makedirs: True

/etc/nginx/sites-enabled/vhost_phpmyadmin:
  file:
    - managed
    - source: salt://templates/database/phpmyadmin/vhost_phpmyadmin
    - mode: 644
    - makedirs: True
  require:
    - service: nginx
    - pkg: phpmyadmin

mariadb-server:
  pkg:
    - installed
    - require:
      - pkgrepo: mariadb_repo
      - file: /etc/mysql/my.cnf
#      - file: /etc/mysql/debian.cnf
  service:
    - name: mysql
    - running
    - enable: True
    - watch:
      - file: /etc/mysql/my.cnf
    - require:
      - pkg: mariadb-server
      - pkg: python-mysqldb

phpmyadmin-group:
  group.present:
    - name: phpmyadmin
    - gid: 7649
    - system: True

phpmyadmin-user:
  user.present:
    - name: phpmyadmin
    - fullname: phpmyadmin
    - gid: 7649
    - groups:
      - phpmyadmin
  require:
    - pkg: phpmyadmin
    - group: phpmyadmin

#db-user:
#    mysql_user.present:
#        - name: {{ pillar.get("dbuser") }}
#        - password: {{ pillar.get("dbpass")}}
#        - host: '%'
#        - connection_user: root
#        - connection_pass: ''
#    mysql_grants.present:
#      - grant: all privileges
#      - grant_option: true
#      - user: {{ pillar.get("dbuser") }}
#      - connection_user: root
#      - connection_pass: ''
#    require:
#      - pkg: python-mysqldb
#
#root-user:
#    mysql_user.absent:
#        - name: root
#        - connection_user: root
#        - connection_pass: ''
#    require:
#        - pkg: python-mysqldb


phpmyadmin:
  pkg:
    - installed
  require:
    - service: mariadb-server

php-fpm-restart:
  service:
    - name: php5-fpm
    - running
    - enable: True
    - reload: True
    - watch:
      - file: /etc/nginx/sites-enabled/vhost_phpmyadmin