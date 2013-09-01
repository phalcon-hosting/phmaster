
phpmyadmin-group:
  group.present:
    - name: nginx-users
    - gid: 7650
    - system: True

# create all the required users
{% for name, vhost in pillar.get('vhosts', {}).iteritems() %}

# create all the databases for the given users
{% for server_name in vhost['server-names'] %}
{{ server_name }}:
  host.present:
    - name: {{ server_name }}
    - ip: 127.0.0.1
{% endfor %}

{{ name }}-vhost:
  user.present:
    - name: {{ vhost["user"] }}
    - fullname: vhost {{ vhost["user"] }}
    - password: {{ vhost["pass"] }}
    - shell: /bin/bash
    - groups:
      - nginx-users
    - require:
      - pkg: nginx
      - group.present: nginx-users

{% set server_names = vhost["server-names"]|join(" ") %}
{% set www_dir = '/var/www/' + vhost["user"] %}

vhost_vhost_{{ vhost["user"] }}:
  file.managed:
    - name: /etc/nginx/sites-enabled/vhost_{{ vhost["user"] }}
    - source: salt://templates/vhost_file
    - mode: 644
    - makedirs: True
    - require:
      - pkg: nginx
      - user.present: {{ vhost["user"] }}

{{ www_dir }}:
  file.recurse:
    - user: {{ vhost["user"] }}
    - group: www-data
    - makedirs: True
    - source: salt://templates/vhost-defaults
    - include_empty: True
    - file_mode: 744
    - dir_mode: 755
    - require:
      - user.present: {{ vhost["user"] }}

     
wwwdir_vhost_{{ vhost["user"] }}:
  file.sed:
    - name: /etc/nginx/sites-enabled/vhost_{{ vhost["user"] }}
    - before: WWW_DIR
    - after: {{ www_dir }}
    - limit: 'root '
    - require:
      - pkg: nginx
      - user.present: {{ vhost["user"] }}

servernames_vhost_{{ vhost["user"] }}:
  file.sed:
    - name: /etc/nginx/sites-enabled/vhost_{{ vhost["user"] }}
    - before: SERVER_NAMES
    - after: {{ server_names }}
    - limit: 'server_name '
    - require:
      - pkg: nginx
      - user.present: {{ vhost["user"] }}


reload-nginx:
  service:
    - name: nginx
    - running
    - reload: True
    - enabled: True
    - watch:
      - file: /etc/nginx/sites-enabled/vhost_{{ vhost["user"] }}

reload-php5-fpm:
  service:
    - name: php5-fpm
    - running
    - reload: True
    - enabled: True
    - watch:
      - file: /etc/nginx/sites-enabled/vhost_{{ vhost["user"] }}

{% endfor %}
