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