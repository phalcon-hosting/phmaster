<!-- Add .dropdown-center-responsive class to align the dropdown menu center (so its visible on mobile) -->

{% set notifType = [
    "0" : "important",
    "1" : "warning",
    "2" : "success"
] %}

<li id="notifications-widget" class="dropdown dropdown-center-responsive">
    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
        <i class="icon-flag"></i>
        {% for type in notifications.listTypes() %}
            {% set numberUnreadNotif = notifications.count(type,true) %}
            {% if numberUnreadNotif > 0 %}
                <span class="badge badge-{{ notifType[type] }}">{{ numberUnreadNotif }}</span>
            {% endif %}
        {% endfor %}
    </a>
    <ul class="dropdown-menu widget">
        <li class="widget-heading"><a href="javascript:void(0)" class="pull-right widget-link"><i class="icon-cog"></i></a><a href="javascript:void(0)" class="widget-link">Notifications</a></li>
        {% for notif in notifications %}
        <li>
            <ul>
                <li class="label label-{{ notifType[notif.type] }}"><span class="updatable-hr-time">{{ notif.created_on }}</span></li>
                <li class="text-{{ notifType[notif.type] }}">{{ notif.message }}</li>
            </ul>
        </li>
        {% endfor %}

        <li class="divider"></li>
        <li class="text-center"><a href="javascript:void(0)">View All Notifications</a></li>
    </ul>
</li>