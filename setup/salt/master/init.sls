include:
  - webserver

master-packages:
  pkg.installed:
    - pkgs:
      - sshpass
      - salt-master

vhost_master:
  file.managed:
    - name: /etc/nginx/sites-enabled/vhost_master
    - source: salt://templates/vhost_file
    - mode: 644
    - template: jinja
    - makedirs: True
    - context:
      www_dir: /usr/local/ph
      server_names: {{ grains['host'] }}
      alt_port: 8888
    - require:
      - pkg: nginx

reload-nginx:
  service:
    - name: nginx
    - running
    - reload: True
    - enable: True
    - watch:
      - file: /etc/nginx/sites-enabled/vhost_master
  cmd.wait:
   - name: wget https://getcomposer.org/installer && php installer && php composer.phar install && rm installer
   - cwd: /usr/local/ph
   - runas: ubuntu
   - watch:
     - file: /etc/nginx/sites-enabled/vhost_master
   - require:
     - pkg: php5-cli

/usr/local/ph/app/cache:
  file.directory:
    - mode: 777
    - recurse:
      - mode
