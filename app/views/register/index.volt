{%  extends "layouts/pannel.volt" %}


{% block content %}
    <?php use Phalcon\Tag; ?>

{% if error is defined %}
    {{ error }}
{% endif %}

<h2>Sign up</h2>
    {{ form("register/index") }}

    <p>
        <p>
            <label for="email">E-Mail</label>
            {{ text_field("email") }}
        </p>

        <p>
            <label for="password">Password</label>
            {{ password_field("password") }}
        </p>

        <p>
            <label for="password">Password repeat</label>
            {{ password_field("password") }}
        </p>
    </p>


    <p>
        <h3>
            Profile:
        </h3>
        <p></p>

        <p>
            <label for="name">Name</label>
            {{ text_field("name") }}
        </p>

        <p>
            <label for="gender">Gender</label>
            {{ select("gender", genderOptions) }}
        </p>
    </p>

    <p>
        {{ submit_button("Register", "class": "btn") }}
    </p>

    {{ end_form() }}
</p>
{% endblock %}