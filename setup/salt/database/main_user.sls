root-user:
  mysql_user.present:
      - name: root
      - password: {{ pillar["root_password"] }}
      - connection_user: root
      - connection_pass: ''
      - require:
        - sls: database
        - service.running: mysql
  # make sure we can access root from all hosts
  mysql_grants.present:
      - grant: 'ALL PRIVILEGES'
      - database: '*.*'
      - host: '%'
      - grant_option: False
      - user: root
      - connection_user: root
      - connection_pass: {{ pillar["root_password"] }}
      - require:
        - mysql_user.present: root
  # remove all the users with empty passwords
  cmd.run:
    - name: mysql -uroot -p{{ pillar["root_password"] }} -e"DELETE FROM mysql.user WHERE password=''; FLUSH PRIVILEGES;"
    - cwd: /tmp
    - watch:
      - mysql_user.present: root
  service.mod_watch:
    - name: php5-fpm
    - full_restart: True
    - require:
      - mysql_user.present: root
