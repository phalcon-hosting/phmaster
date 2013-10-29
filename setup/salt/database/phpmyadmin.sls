{% set phpmyadmin_dir = '/usr/share/phpmyadmin' %}

{{ phpmyadmin_dir }}:
  file.directory:
    - user: ubuntu
    - group: www-data
    - dir_mode: 755
    - file_mode: 755
    - recurse:
      - user
      - group
      - mode

# download and install phpmyadmin from git
phpmyadmin:
  git.latest:
    - name: https://github.com/phpmyadmin/phpmyadmin.git
    - rev: STABLE
    - runas: ubuntu
    - target: {{ phpmyadmin_dir }}
    - require:
      - pkg: git
      - pkg: php5-dev
      - service.running: mysql
      - file.directory: {{ phpmyadmin_dir }}
  cmd.wait:
   - name: 'mysql -uroot -p{{ pillar["root_password"] }} < {{ phpmyadmin_dir }}/examples/create_tables.sql'
   - cwd: /tmp
   - runas: ubuntu
   - watch:
     - git: phpmyadmin
     - mysql_database.present: phpmyadmin

{{ phpmyadmin_dir }}/config.inc.php:
  file.managed:
    - source: salt://templates/database/phpmyadmin/config.inc.php
    - mode: 644
    - makedirs: True
    - group: www-data
    - template: jinja
    - user: ubuntu
    - context:
      blowfish_secret: {{ pillar["blowfish_hash"] }}
    - require:
      - git: phpmyadmin

{{ phpmyadmin_dir }}/config-db.php:
  file.managed:
    - source: salt://templates/database/phpmyadmin/config-db.php
    - mode: 644
    - makedirs: True
    - user: ubuntu
    - group: www-data
    - template: jinja
    - context:
      test_pass: {{ pillar["test_password"] }}
    - require:
      - git: phpmyadmin

# setup the control user
phpmyadmin-user:
  mysql_user.present:
        - name: phpmyadmin
        - password: {{ pillar["test_password"] }}
        - allow_passwordless: False
        - host: 'localhost'
        - connection_user: root
        - connection_pass: {{ pillar["root_password"] }}
        - require:
          - file: {{ phpmyadmin_dir }}/config-db.php
          - service.running: mysql
  mysql_database.present:
      - name: phpmyadmin
      - connection_user: root
      - connection_pass: {{ pillar["root_password"] }}
      - require:
        - mysql_user.present: phpmyadmin
  mysql_grants.present:
      - grant: 'ALL PRIVILEGES'
      - database: phpmyadmin.*
      - host: 'localhost'
      - grant_option: False
      - user:  phpmyadmin
      - connection_user: root
      - connection_pass: {{ pillar["root_password"] }}
      - require:
        - mysql_database.present: phpmyadmin

# set up the vhost
/etc/nginx/sites-enabled/vhost_phpmyadmin:
  file.managed:
    - source: salt://templates/database/phpmyadmin/vhost_phpmyadmin
    - mode: 644
    - template: jinja
    - context:
      hostname: {{ grains['host'] }}
    - makedirs: True

php-fpm-restart:
  service:
    - name: php5-fpm
    - running
    - enable: True
    - reload: True
    - watch:
      - file: /etc/nginx/sites-enabled/vhost_phpmyadmin
    - require:
      - sls: webserver.phpfpm
