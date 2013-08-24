db-user:
    service:
      - name: mysql
      - running
      - enable: True
      - reload: True
      - require:
        - sls: database
    mysql_user.present:
      - name: {{ pillar["dbuser"] }}
      - password: {{ pillar["dbpass"] }}
      - allow_passwordless: False
      - host: '%'
      - connection_user: root
      - connection_pass: ''
      - require:
        - service: mysql
        - sls: database
    mysql_grants.present:
      - grant: 'ALL PRIVILEGES'
      - database: '*.*'
      - host: '%'
      - grant_option: True
      - user: {{ pillar["dbuser"] }}
      - connection_user: root
      - connection_pass: ''
      - require:
        - mysql_user: {{ pillar["dbuser"] }}
        - pkg: phpmyadmin

root-user:
    mysql_user.absent:
      - name: root
      - connection_user: root
      - connection_pass: ''
      - require:
        - pkg: python-mysqldb
        - mysql_user: {{ pillar["dbuser"] }}
        - service: mysql
