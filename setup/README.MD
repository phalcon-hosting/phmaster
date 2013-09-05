Vhost pillar structure:
---------------------------
vhosts:
  test-dev:
    server-names:
      - test.dev
      - test2.dev
    user: 'testuser01'



Database users pillar structure:
-------------------------------
database-users:
  test:
    password: password
    databases:
      - test