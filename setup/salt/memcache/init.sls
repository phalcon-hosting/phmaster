#nginx-packages:
#  pkg.installed:
#    - pkgs:
#      - nginx
#      - php5-fpm
#
#fpm-php-ini:
#    file.managed:
#        - name: /etc/php5/fpm/php.ini
#        - source: salt://templates/php/php.ini
#        - template: jinja
#        - user: www-data
#        - group: www-data
#        - mode: 755
#
#fpm-www:
#  file.managed:
#      - name: /etc/php5/fpm/pool.d/www.conf
#      - source: salt://templates/www.conf
#      - template: jinja
#      - user: www-data
#      - group: www-data
#      - mode: 755
#
#
#nginx-conf:
#    file.managed:
#        - name: /etc/nginx/nginx.conf
#        - source: salt://templates/nginx.conf
#        - template: jinja
#        - user: www-data
#        - group: www-data
#        - mode: 755
#
#nginx-default:
#  file.absent:
#        - name: /etc/nginx/sites-available/default
#
#nginx-default-en:
#  file.absent:
#        - name: /etc/nginx/sites-enabled/default
#
#nginx:
#    pkg.installed:
#        - name: nginx
#    service.running:
#        - enable: True
