phalcon:
  git.latest:
    - name: https://github.com/phalcon/cphalcon.git
    - rev: master
    - runas: ubuntu
    - target: /tmp/cphalcon
    - force: true
    - require:
      - pkg: git
      - pkg: php5-dev
  cmd.wait:
   - name: ./exiinstall
   - cwd: /tmp/cphalcon/build
   - watch:
     - git: phalcon


phalcon-ini:
    file.managed:
        - name: /etc/php5/conf.d/phalcon.ini
        - source: salt://templates/php/conf.d/phalcon.ini
        - template: jinja
        - user: www-data
        - group: www-data
        - mode: 755