include:
  - webserver.phpfpm

nginx-packages:
  pkg.installed:
    - pkgs:
      - nginx
      - beanstalkd

nginx-conf:
    file.managed:
        - name: /etc/nginx/nginx.conf
        - source: salt://templates/nginx.conf
        - template: jinja
        - user: www-data
        - group: www-data
        - mode: 755

nginx-default:
  file.absent:
        - name: /etc/nginx/sites-available/default
        - require:
              - pkg: nginx

nginx-default-en:
  file.absent:
        - name: /etc/nginx/sites-enabled/default
        - require:
              - pkg: nginx

nginx:
    pkg.installed:
        - name: nginx
    service.running:
        - enable: True

nginx-group:
  group.present:
    - name: nginx-users
    - gid: 7650
    - system: True