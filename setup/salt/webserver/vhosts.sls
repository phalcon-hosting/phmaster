# create all the required users
{% for name, vhost in pillar.get('vhosts', {}).iteritems() %}

{% set server_names = vhost["server-names"]|join(" ") %}
{% set www_dir = '/var/www/' + vhost["user"] %}


# create all the databases for the given users
{% for server_name in vhost['server-names'] %}
{{ server_name }}:
  host.present:
    - name: {{ server_name }}
    - ip: 127.0.0.1
{% endfor %}

# the user's home directory must be owned by root (for chroot)
{{ www_dir }}:
  file.recurse:
    - user: root
    - group: www-data
    - makedirs: True
    - source: salt://templates/vhost-defaults
    - include_empty: True
    - file_mode: 744
    - dir_mode: 755

{{ name }}-vhost:
  user.present:
    - name: {{ vhost["user"] }}
    - fullname: vhost {{ vhost["user"] }}
    - password: {{ vhost["pass"] }}
    - home: {{ www_dir }}
    - shell: /bin/bash
    - groups:
      - nginx-users
    - require:
      - pkg: nginx
      - group.present: nginx-users
      - file.directory: {{ www_dir }}

vhost_{{ vhost["user"] }}:
  file.managed:
    - name: /etc/nginx/sites-enabled/vhost_{{ vhost["user"] }}
    - source: salt://templates/vhost_file
    - mode: 644
    - template: jinja
    - makedirs: True
    - context:
      www_dir: {{ www_dir }}
      server_names: {{ server_names }}
    - require:
      - pkg: nginx
      - user.present: {{ vhost["user"] }}

reload-nginx:
  service:
    - name: nginx
    - running
    - reload: True
    - enable: True
    - watch:
      - file: /etc/nginx/sites-enabled/vhost_{{ vhost["user"] }}

reload-php5-fpm:
  service:
    - name: php5-fpm
    - running
    - reload: True
    - enable: True
    - watch:
      - file: /etc/nginx/sites-enabled/vhost_{{ vhost["user"] }}

{% endfor %}
