
# create all the required users
{% for mysqluser, user in pillar.get('database-users', {}).iteritems() %}

mysql-user-{{ mysqluser }}:
  mysql_user.present:
        - name: {{ mysqluser }}
        - password: {{ user["password"] }}
        - allow_passwordless: False
        - host: '%'
        - connection_user: root
        - connection_pass: {{ pillar["root_password"] }}
        - require:
          - service: mysql
          - sls: database

  # create all the databases for the given users
  {% for database in user['databases'] %}
  mysql_database.present:
        - name: {{ database }}
        - connection_user: root
        - connection_pass: {{ pillar["root_password"] }}
        - require:
          - mysql_user.present: {{ mysqluser }}
          - sls: database
  mysql_grants.present:
        - grant: 'ALL PRIVILEGES'
        - database: {{ database }}.*
        - host: '%'
        - grant_option: False
        - user:  {{ mysqluser }}
        - connection_user: root
        - connection_pass: {{ pillar["root_password"] }}
        - require:
          - mysql_database.present: {{ database }}
          - sls: database
  {% endfor %}


{% endfor %}
