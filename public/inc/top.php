<?php
/**
 * top.php
 *
 * Author: pixelcave
 *
 * The first block of code used in every page of the template
 * Start of html, <head> tag, as well as the header of the page are included here
 *
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title><?php echo $template['title'] ?></title>

        <meta name="description" content="<?php echo $template['description'] ?>">
        <meta name="author" content="<?php echo $template['author'] ?>">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57-precomposed.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- The roboto font is included from Google Web Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic">

        <!-- Bootstrap 2.3.2 is included in its original form, unaltered -->
        <link rel="stylesheet" href="css/bootstrap.css">

        <!-- Related styles of various javascript plugins -->
        <link rel="stylesheet" href="css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="css/main.css">

        <!-- Load a specific file here from css/themes/ folder to alter the default theme of all the template -->
        <?php if ($template['theme']) { ?>
        <link id="theme-link" rel="stylesheet" href="css/themes/<?php echo $template['theme']; ?>.css">
        <?php } ?>

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements (must included last) -->
        <link rel="stylesheet" href="css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (Browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support them) -->
        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>

    <!-- Add the class .fixed to <body> for a fixed layout on large resolutions (min: 1200px) -->
    <!-- <body class="fixed"> -->
    <body<?php if ($template['layout'] == 'fixed') echo ' class="fixed"'; ?>>
        <!-- Page Container -->
        <div id="page-container">
            <!-- Header -->
            <!-- Add the class .navbar-fixed-top or .navbar-fixed-bottom for a fixed header on top or bottom respectively -->
            <!-- <header class="navbar navbar-inverse navbar-fixed-top"> -->
            <!-- <header class="navbar navbar-inverse navbar-fixed-bottom"> -->
            <header class="navbar navbar-inverse<?php if ($template['header'] == 'fixed-top') echo ' navbar-fixed-top'; else if ($template['header'] == 'fixed-bottom') echo ' navbar-fixed-bottom'; ?>">
                <!-- Navbar Inner -->
                <div class="navbar-inner remove-radius remove-box-shadow">
                    <!-- div#container-fluid -->
                    <div class="container-fluid">
                        <!-- Mobile Navigation, Shows up  on smaller screens -->
                        <ul class="nav pull-right visible-phone visible-tablet">
                            <li class="divider-vertical remove-margin"></li>
                            <li>
                                <!-- It is set to open and close the main navigation on smaller screens. The class .nav-collapse was added to aside#page-sidebar -->
                                <a href="javascript:void(0)" data-toggle="collapse" data-target=".nav-collapse">
                                    <i class="icon-reorder"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- END Mobile Navigation -->

                        <!-- Logo -->
                        <a href="index.php" class="brand"><img src="img/template/logo.png" alt="logo"></a>

                        <!-- Loading Indicator, Used for demostrating how loading of widgets could happen, check main.js - uiDemo() -->
                        <div id="loading" class="hide pull-left"><i class="icon-certificate icon-spin"></i></div>

                        <!-- Header Widgets -->
                        <!-- You can create the widgets you want by replicating the following. Each one exists in a <li> element -->
                        <ul id="widgets" class="nav pull-right">

                            <!-- Just a divider -->
                            <li class="divider-vertical remove-margin"></li>

                            <!-- RSS Widget -->
                            <!-- Add .dropdown-left-responsive class to align the dropdown menu left (so its visible on mobile) -->
                            <li id="rss-widget" class="dropdown dropdown-left-responsive">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-rss"></i>
                                    <span class="badge badge-warning display-none"></span>
                                </a>
                                <!-- By adding the class .widget-fluid, dropdown width will be set to auto with min value 180px and max value 250px -->
                                <ul class="dropdown-menu widget widget-fluid">
                                    <li class="widget-heading text-center">Web Design</li>
                                    <li class="li-hover"><a href="javascript:void(0)" class="widget-link"><i class="icon-umbrella"></i>This is a headline</a></li>
                                    <li class="divider"></li>
                                    <li class="li-hover"><a href="javascript:void(0)" class="widget-link"><i class="icon-trophy"></i>Another headline</a></li>
                                    <li class="divider"></li>
                                    <li class="li-hover"><a href="javascript:void(0)" class="widget-link"><i class="icon-suitcase"></i>Headlines keep coming!</a></li>
                                    <li class="widget-heading text-center">Web Developent</li>
                                    <li class="li-hover"><a href="javascript:void(0)" class="widget-link"><i class="icon-phone"></i>New headline</a></li>
                                    <li class="divider"></li>
                                    <li class="li-hover"><a href="javascript:void(0)" class="widget-link"><i class="icon-pencil"></i>Another one</a></li>
                                    <li class="divider"></li>
                                    <li><a href="javascript:void(0)" class="text-center">All News</a></li>
                                </ul>
                            </li>
                            <!-- END RSS Widget -->

                            <li class="divider-vertical remove-margin"></li>

                            <!-- Twitter Widget -->
                            <!-- Add .dropdown-left-responsive class to align the dropdown menu left (so its visible on mobile) -->
                            <li id="twitter-widget" class="dropdown dropdown-left-responsive">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-twitter"></i>
                                    <span class="badge badge-info display-none"></span>
                                </a>
                                <ul class="dropdown-menu widget">
                                    <li class="widget-heading"><i class="icon-comments-alt pull-right"></i>Latest Tweets</li>
                                    <li class="li-hover">
                                        <div class="media">
                                            <a class="pull-left" href="javascript:void(0)">
                                                <img src="img/placeholders/image_dark_64x64.png" alt="fakeimg">
                                            </a>
                                            <div class="media-body">
                                                <h6 class="media-heading"><a href="javascript:void(0)">Michael</a><span class="label label-info">just now</span></h6>
                                                <div class="media">Web design all the way!</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="li-hover">
                                        <div class="media">
                                            <a class="pull-left" href="javascript:void(0)">
                                                <img src="img/placeholders/image_dark_64x64.png" alt="fakeimg">
                                            </a>
                                            <div class="media-body">
                                                <h6 class="media-heading"><a href="javascript:void(0)">Monica</a><span class="label label-info">3 min ago</span></h6>
                                                <div class="media">Download free PSDs at <a href="http://bit.ly/YUs4SQ" target="_blank">http://bit.ly/YUs4SQ</a></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="li-hover">
                                        <div class="media">
                                            <a class="pull-left" href="javascript:void(0)">
                                                <img src="img/placeholders/image_dark_64x64.png" alt="fakeimg">
                                            </a>
                                            <div class="media-body">
                                                <h6 class="media-heading"><a href="javascript:void(0)">Steven</a><span class="label label-info">45 min ago</span></h6>
                                                <div class="media">Be sure to check out my portfolio!</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="li-hover">
                                        <div class="media">
                                            <a class="pull-left" href="javascript:void(0)">
                                                <img src="img/placeholders/image_dark_64x64.png" alt="fakeimg">
                                            </a>
                                            <div class="media-body">
                                                <h6 class="media-heading"><a href="javascript:void(0)">Tim</a><span class="label label-info">1 hour ago</span></h6>
                                                <div class="media">Get all our themes for free for the next 2 hours! <a href="javascript:void(0)">#freebies</a></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- END Twitter Widget -->

                            <li class="divider-vertical remove-margin"></li>

                            <!-- Messages Widget -->
                            <!-- Add .dropdown-left-responsive class to align the dropdown menu left (so its visible on mobile) -->
                            <li id="messages-widget" class="dropdown dropdown-left-responsive">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-envelope"></i>
                                    <!-- If the <span> element with .badge class has no content it will disappear (not in IE8 and below because of using :empty in CSS) -->
                                    <span class="badge badge-success">1</span>
                                </a>
                                <ul class="dropdown-menu widget pull-right">
                                    <li class="widget-heading"><i class="icon-comment pull-right"></i>Latest Messages</li>
                                    <li class="new-on">
                                        <div class="media">
                                            <a class="pull-left" href="javascript:void(0)">
                                                <img src="img/placeholders/image_light_64x64.png" alt="fakeimg">
                                            </a>
                                            <div class="media-body">
                                                <h6 class="media-heading"><a href="javascript:void(0)">George</a><span class="label label-success">2 min ago</span></h6>
                                                <div class="media">Thanks for your help! The tutorial really helped me a lot!</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="media">
                                            <a class="pull-left" href="javascript:void(0)">
                                                <img src="img/placeholders/image_light_64x64.png" alt="fakeimg">
                                            </a>
                                            <div class="media-body">
                                                <h6 class="media-heading"><a href="javascript:void(0)">Mike</a><span class="label">6 hours ago</span></h6>
                                                <div class="media">The logo is ready, have a look and let me know what you think!</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="media">
                                            <a class="pull-left" href="javascript:void(0)">
                                                <img src="img/placeholders/image_light_64x64.png" alt="fakeimg">
                                            </a>
                                            <div class="media-body">
                                                <h6 class="media-heading"><a href="javascript:void(0)">Julia</a><span class="label">1 day ago</span></h6>
                                                <div class="media">We should better consider our social media marketing strategy!</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="text-center"><a href="page_inbox.php">View All Messages</a></li>
                                </ul>
                            </li>
                            <!-- END Messages Widget -->

                            <li class="divider-vertical remove-margin"></li>

                            <!-- Notifications Widget -->
                            <!-- Add .dropdown-center-responsive class to align the dropdown menu center (so its visible on mobile) -->
                            <li id="notifications-widget" class="dropdown dropdown-center-responsive">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-flag"></i>
                                    <span class="badge badge-important">1</span>
                                    <span class="badge badge-warning">2</span>
                                </a>
                                <ul class="dropdown-menu widget">
                                    <li class="widget-heading"><a href="javascript:void(0)" class="pull-right widget-link"><i class="icon-cog"></i></a><a href="javascript:void(0)" class="widget-link">System</a></li>
                                    <li>
                                        <ul>
                                            <li class="label label-important">20 min ago</li>
                                            <li class="text-error">Support system is down for maintenance!</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li class="label label-warning">3 hours ago</li>
                                            <li class="text-warning">PHP upgrade started!</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li class="label label-warning">5 hours ago</li>
                                            <li class="text-warning"><a href="javascript:void(0)" class="widget-link">1 support ticket</a> just opened!</li>
                                        </ul>
                                    </li>
                                    <li class="widget-heading"><a href="javascript:void(0)" class="pull-right widget-link"><i class="icon-bookmark"></i></a><a href="javascript:void(0)" class="widget-link">Project #3</a></li>
                                    <li>
                                        <ul>
                                            <li class="label label-success">3 weeks ago</li>
                                            <li class="text-success">Project #3 <a href="javascript:void(0)" class="widget-link">published</a> successfully!</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li class="label label-info">1 month ago</li>
                                            <li class="text-info">Milestone #3 achieved!</li>
                                            <li class="text-info"><a href="javascript:void(0)" class="widget-link">John Doe</a> joined the project!</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li class="label">1 year ago</li>
                                            <li class="text-muted">This is an old notification</li>
                                        </ul>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="text-center"><a href="javascript:void(0)">View All Notifications</a></li>
                                </ul>
                            </li>
                            <!-- END Notifications Widget -->

                            <li class="divider-vertical remove-margin"></li>

                            <!-- User Menu -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><img src="img/template/avatar.png" alt="avatar"> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <!-- Just a button demostrating how loading of widgets could happen, check main.js- - uiDemo() -->
                                    <li>
                                        <a href="javascript:void(0)" class="loading-on"><i class="icon-refresh"></i> Refresh</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <!-- Modal div is at the bottom of the page before including javascript code -->
                                        <a href="#modal-user-settings" role="button" data-toggle="modal"><i class="icon-user"></i> User Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><i class="icon-wrench"></i> App Settings</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="page_login.php"><i class="icon-lock"></i> Log out</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END User Menu -->
                        </ul>
                        <!-- END Header Widgets -->
                    </div>
                    <!-- END div#container-fluid -->
                </div>
                <!-- END Navbar Inner -->
            </header>
            <!-- END Header -->

            <!-- Inner Container -->
            <div id="inner-container">