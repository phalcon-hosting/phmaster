{%  extends "layouts/noAuth.volt" %}


{% block content %}
    <?php use Phalcon\Tag; ?>

{% if error is defined %}
    {{ error }}
{% endif %}


    <div class="login-block">
        <h2>Sign up</h2>
        {{ form("register") }}


                <label for="email">E-Mail</label>
                {{ text_field("email") }}

                <label for="password">Password</label>
                {{ password_field("password") }}

                <label for="password">Password repeat</label>
                {{ password_field("password") }}



                Profile:

                <label for="name">Name</label>
                {{ text_field("name") }}

                <label for="gender">Gender</label>
                {{ select("gender", genderOptions) }}


            {{ submit_button("Register", "class": "btn") }}

        {{ end_form() }}
    </div>
{% endblock %}