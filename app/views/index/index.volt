{%  extends "layouts/panel.volt" %}


{% block content_title %}

    Phalcon Hosting <small>Home</small>

{% endblock %}

{% block content %}


    {%  if hostingAccounts | length > 0 %}

        <ul>

            {% for hAccount in hostingAccounts %}

                <li>Hosting account</li>

            {% endfor %}

        </ul>

    {% else %}
        <div>
            {{ t("There is no registered hosting account") }}
        </div>
        <div>
            <a href="/hosting/register">{{ t("Register a new hosting account") }}</a>
        </div>
    {% endif %}


{% endblock %}