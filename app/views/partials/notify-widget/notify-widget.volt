<!-- Add .dropdown-center-responsive class to align the dropdown menu center (so its visible on mobile) -->
<li id="notifications-widget" class="dropdown dropdown-center-responsive">
    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
        <i class="icon-flag"></i>
        {% if notifications.getNotifications("important")|length > 0 %}
        <span class="badge badge-important">{{ notifications.getNotifications("important")|length }}</span>
        {% endif %}
        {% if notifications.getNotifications("warning")|length > 0 %}
            <span class="badge badge-warning">{{ notifications.getNotifications("warning")|length }}</span>
        {% endif %}
    </a>
    <ul class="dropdown-menu widget">
        <li class="widget-heading"><a href="javascript:void(0)" class="pull-right widget-link"><i class="icon-cog"></i></a><a href="javascript:void(0)" class="widget-link">System</a></li>
        {% for notif in notifications %}
        <li>
            <ul>
                <li class="label label-{{ notif.type }}"><span class="updatable-hr-time">{{ notif.creation }}</span></li>
                <li class="text-{{ notif.type }}">{{ notif.message }}</li>
            </ul>
        </li>
        {% endfor %}

        <li class="divider"></li>
        <li class="text-center"><a href="javascript:void(0)">View All Notifications</a></li>
    </ul>
</li>