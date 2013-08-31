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

mariadb-server:
  pkg:
    - installed
    - require:
      - pkgrepo: mariadb_repo
      - file: /etc/mysql/my.cnf
  service:
   - name: mysql
   - dead
   - enable: False
   - reload: True
   - require:
      - pkgrepo: mariadb_repo
      - file: /etc/mysql/my.cnf

/etc/nginx/sites-enabled/vhost_phpmyadmin:
  file.managed:
    - source: salt://templates/database/phpmyadmin/vhost_phpmyadmin
    - mode: 644
    - makedirs: True

/etc/phpmyadmin/config.inc.php:
  file.managed:
    - source: salt://templates/database/phpmyadmin/config.inc.php
    - mode: 644
    - makedirs: True
    - require:
      - pkg: phpmyadmin


host-phpmyadmin:
    file.sed:
      - name: /etc/nginx/sites-enabled/vhost_phpmyadmin
      - before: HOSTNAME
      - after: {{ grains['host'] }}
      - limit: 'server_name '
      - require:
        - pkg: phpmyadmin

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
    - require:
      - pkg: phpmyadmin
      - group: phpmyadmin

phpmyadmin:
  pkg:
    - installed

php-fpm-restart:
  service:
    - name: php5-fpm
    - dead
    - enable: False
    - reload: True
    - watch:
      - file: /etc/nginx/sites-enabled/vhost_phpmyadmin


mariadb-restart:
  service:
    - name: mysql
    - running
    - enable: True
    - reload: True
    - require:
      - pkg: phpmyadmin
      - pkg: mariadb-server



/etc/phpmyadmin/config.inc.php:
  file.sed:
    - before: "'TEST_PASS'"
    - after: "'{{ pillar["test_password"] }}'"
    - limit: '^dbpass='
    - require:
      -  pkg: phpmyadmin
