<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    {{ get_title() }}
    <!-- Mobile Devices -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Boostrap -->
    {{ stylesheet_link('css/bootstrap.css') }}


    {{ stylesheet_link('css/main.css') }}
    {{ stylesheet_link('css/plugins.css') }}
    {{ stylesheet_link('css/themes.css') }}
    {{ stylesheet_link('css/fancybox.css') }}
    {{ stylesheet_link('css/colors/aqua-green.css') }}

    <!-- Stylesheet for PH -->
    {{ stylesheet_link('css/ph.css') }}


    <link href="http://fonts.googleapis.com/css?family=Oswald:400,300" rel="stylesheet" type="text/css" media="screen"/>

    <!-- Scripts -->
    <script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>
    {{ javascript_include('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js') }}
    {{ javascript_include('js/vendor/bootstrap.min.js') }}
    {{ javascript_include('js/plugins.js') }}
    {{ javascript_include('js/main.js') }}
    <link rel="icon" type="image/ico" href="/favicon.png"/>
</head>
<body class="no-auth">
    {% block content %}
    {% endblock %}
</body>
</html>