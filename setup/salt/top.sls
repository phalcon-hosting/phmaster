base:
  '*':
      - requirements
      - baseserver
      - phalcon
  'role:webserver':
      - match: grain
      - webserver
      - webserver.vhosts
  'role:database':
      - match: grain
      - database
      - database.user_accounts
      - database.phpmyadmin
  'role:memcache':
      - match: grain
      - memcache
  'master*':
      - master