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
        You have no register hosting account. [Register Link]
    {% endif %}


{% endblock %}