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
  'role:memcache':
      - match: grain
      - memcache
  'master*':
    - master