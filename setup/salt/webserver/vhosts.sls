
phpmyadmin-group:
  group.present:
    - name: nginx-users
    - gid: 7650
    - system: True

# create all the required users
{% for name, vhost in pillar.get('vhosts', {}).iteritems() %}

# create all the databases for the given users
{% for server_name in vhost['server-names'] %}
{{ name }}:
  host.present:
    - name: {{ server_name }}
    - ip: 127.0.0.1
{% endfor %}

{{ name }}-vhost:
  user.present:
    - name: {{ vhost["generated-user"] }}
    - fullname: vhost {{ vhost["generated-user"] }}
    - groups:
      - nginx-users
    - require:
      - pkg: nginx
      - group.present: nginx-users

{% set server_names = vhost["server-names"]|join(" ") %}
{% set www_dir = '/var/www/' + vhost["generated-user"] %}

vhost_vhost_{{ vhost["generated-user"] }}:
  file.managed:
    - name: /etc/nginx/sites-enabled/vhost_{{ vhost["generated-user"] }}
    - source: salt://templates/vhost_file
    - mode: 644
    - makedirs: True
    - require:
      - pkg: nginx
      - user.present: {{ vhost["generated-user"] }}

{{ www_dir }}:
  file.directory:
    - user: {{ vhost["generated-user"] }}
    - group: www-data
    - file_mode: 744
    - dir_mode: 755
    - require:
      - user.present: {{ vhost["generated-user"] }}

wwwdir_vhost_{{ vhost["generated-user"] }}:
  file.sed:
    - name: /etc/nginx/sites-enabled/vhost_{{ vhost["generated-user"] }}
    - before: WWW_DIR
    - after: {{ www_dir }}
    - limit: 'root '
    - require:
      - pkg: nginx
      - user.present: {{ vhost["generated-user"] }}

servernames_vhost_{{ vhost["generated-user"] }}:
  file.sed:
    - name: /etc/nginx/sites-enabled/vhost_{{ vhost["generated-user"] }}
    - before: SERVER_NAMES
    - after: {{ server_names }}
    - limit: 'server_name '
    - require:
      - pkg: nginx
      - user.present: {{ vhost["generated-user"] }}

reload-nginx:
  service:
    - name: nginx
    - running
    - reload: True
    - enabled: True
    - watch:
      - file: /etc/nginx/sites-enabled/vhost_{{ vhost["generated-user"] }}

{% endfor %}
