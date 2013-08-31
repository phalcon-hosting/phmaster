{%  extends "layouts/noAuth.volt" %}

{% block content %}


    <div class="login-block">

        <h2>Login to Phalcon Hosting</h2>


        <form action="#" method="post">
            <div>
                <label>{{ t("Email") }}</label>
                <input type="text" name="email" />

                <label>{{ t("password") }}</label>
                <input type="text" name="email" />

                <input class="ph-login" type="submit" value="{{ t("Sign in") }}" />
                <div class="ph-register-link"><a href="/register" >{{ t("Or create an account") }}</a></div>

            </div>
        </form>

        <a class="ph-service-login ph-service-login-left" href="/auth/github"><img src="/img/ph/login/github-service-icon.png"/>{{ t("Login with Github") }}</a>
        <a class="ph-service-login ph-service-login-right" href="/auth/google">{{ t('Login with Google') }}<img src="/img/ph/login/google-service-icon.png"/></a>
        <div style="clear: both"></div>
    </div>
{% endblock %}
