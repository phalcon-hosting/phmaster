cron:
  pkg:
      - installed
  service.running:
      - enable: True
      - require:
        - pkg: cron

{% for job, args in pillar.get('cron', {}).items() %}
{{ job }}:
cron.present:
  - user: {{ args.get('user', 'root') }}
  - minute: {{ args.get('minute', '*') }}
  - hour: {{ args.get('hour', '*') }}
  - daymonth: {{ args.get('daymonth', '*') }}
  - month: {{ args.get('month', '*') }}
  - dayweek: {{ args.get('dayweek', '*') }}
{% endfor %}