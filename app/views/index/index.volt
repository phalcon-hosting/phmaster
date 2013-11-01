{%  extends "layouts/panel.volt" %}

{% block content %}

    <div id="dashboard-page">
    {%  if hostingAccounts | length > 0 %}

        <ul>

            {% for hAccount in hostingAccounts %}

                <li>Hosting account</li>

            {% endfor %}

        </ul>

    {% else %}

            <div class="welcome-username">
                {%  set username = user.getUsername()  %}
                Hey {% if username is empty %}{{ user.getName() }}{% else %} {{ username }}{% endif %}!
            </div>
            <div class="welcome-message">
                {{ t("Welcome to your Phalcon Hosting <span class='ph-highlighted-words'>Dashboard</span>") }}
            </div>
            <div class="no-account">
                {{ t("For the moment you have not register any Hosting Account") }}
            </div>
            <div class="register-first-account">
                {{ t("Register your <a href='/hosting/register'>first Hosting Account</a> and start flying with Phalcon Hosting!") }}
            </div>
            <div class="register-button">
                <a class="ph-button-1" href="/hosting/register">{{ t("Register my first Hosting Account") }}</a>
            </div>
    {% endif %}
    </div>

{% endblock %}