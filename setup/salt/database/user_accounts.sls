
db-user:
    # create all the required users
    {% for user in pillar["database-users"] %}
    mysql_user.present:
          - name:  {{ user["name"] }}
          - password: {{ user["password"] }}
          - allow_passwordless: False
          - host: '%'
          - connection_user: root
          - connection_pass: {{ pillar["root_password"] }}
          - require:
            - service: mysql
            - sls: database.main_user
    # create all the databases for the given users
    {% for database in user["databases"] %}
    mysql_database.present:
          - name: {{ database }}
          - connection_user: root
          - connection_pass: {{ pillar["root_password"] }}
          - require:
            - mysql_user.present: {{ user["name"] }}
            - sls: database.main_user
    mysql_grants.present:
          - grant: 'ALL PRIVILEGES'
          - database: {{ database }}.*
          - host: '%'
          - grant_option: False
          - user:  {{ user["name"] }}
          - connection_user: root
          - connection_pass: {{ pillar["root_password"] }}
          - require:
            - mysql_database.present: {{ database }}
            - sls: database.main_user
    {% endfor %}


    {% endfor %}
