base:
  'role:database':
    - match: grain
    - database
    - database_users
  'role:webserver':
    - match: grain
    - vhosts


