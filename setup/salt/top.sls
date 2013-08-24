base:
  '*':
    - requirements
    - baseserver
    - phalcon
  'role:webserver':
    - match: grain
    - webserver
  'role:database':
      - match: grain
      - database
      - database.mariadb_user
  'role:memcache':
      - match: grain
      - memcache
  'master*':
    - master