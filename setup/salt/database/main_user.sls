root-user:
  mysql_user.present:
      - name: root
      - password: {{ pillar["root_password"] }}
      - connection_user: root
      - connection_pass: ''
      - require:
        - service.running: mysql

  # remove all the users with empty passwords
  cmd.run:
    - name: mysql -uroot -p{{ pillar["root_password"] }} -e"DELETE FROM mysql.user WHERE password=''; FLUSH PRIVILEGES;"
    - cwd: /tmp
    - watch:
      - mysql_user.present: root

watch-php5-fpm:
  service.mod_watch:
    - name: php5-fpm
    - full_restart: True
    - require:
      - sls: webserver.phpfpm
      - pkg: phpmyadmin
