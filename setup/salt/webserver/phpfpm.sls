php-fpm-packages:
  pkg.installed:
    - pkgs:
      - php5-fpm


redis:
  pecl.installed:
  - require:
      - sls: baseserver

mongo:
  pecl.installed:
  - require:
      - sls: baseserver

fpm-php-ini:
  file.managed:
    - name: /etc/php5/fpm/php.ini
    - source: salt://templates/php/php.ini
    - template: jinja
    - user: www-data
    - group: www-data
    - mode: 755

fpm-www:
  file.managed:
    - name: /etc/php5/fpm/pool.d/www.conf
    - source: salt://templates/php-fpm/www.conf
    - template: jinja
    - user: www-data
    - group: www-data
    - mode: 755