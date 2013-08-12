<?php
/**
 * footer.php
 *
 * Author: pixelcave
 *
 * The footer of the page
 * Jquery library as well as all other scripts are included here
 *
 */
?>
        <!-- Footer -->
        <footer>
            <span id="year-copy"></span> &copy; <strong><a href="http://goo.gl/9QhXQ"><?php echo $template['name'] . ' ' . $template['version']; ?></a></strong> - Crafted with <i class="icon-heart"></i> by <strong><a href="http://goo.gl/vNS3I" target="_blank">pixelcave</a></strong>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Inner Container -->
</div>
<!-- END Page Container -->

<!-- Scroll to top link, check main.js - scrollToTop() -->
<a href="#" id="to-top"><i class="icon-chevron-up"></i></a>

<!-- User Modal Settings, appears when clicking on 'User Settings' link found on user dropdown menu (header, top right) -->
<div id="modal-user-settings" class="modal hide">
    <!-- Modal Header -->
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4>Profile Settings</h4>
    </div>
    <!-- END Modal Header -->

    <!-- Modal Content -->
    <div class="modal-body">
        <!-- Example Tabs, initialized at main.js - uiDemo() -->
        <!-- Tab links -->
        <ul id="example-user-tabs" class="nav nav-tabs">
            <li class="active"><a href="#example-user-tabs-account"><i class="icon-cogs"></i> Account</a></li>
            <li><a href="#example-user-tabs-profile"><i class="icon-user"></i> Profile</a></li>
        </ul>
        <!-- END Tab links -->

        <!-- END Tab Content -->
        <div class="tab-content">
            <!-- First Tab -->
            <div class="tab-pane active" id="example-user-tabs-account">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> Password changed!
                </div>
                <form class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="example-user-username">Username</label>
                        <div class="controls">
                            <input type="text" id="example-user-username" class="disabled" value="administrator" disabled="">
                            <span class="help-block">You can't change your username!</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-user-pass">Password</label>
                        <div class="controls">
                            <input type="password" id="example-user-pass">
                            <span class="help-block">if you want to change your password enter your current for confirmation!</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-user-newpass">New Password</label>
                        <div class="controls">
                            <input type="password" id="example-user-newpass">
                        </div>
                    </div>
                </form>
            </div>
            <!-- END First Tab -->

            <!-- Second Tab -->
            <div class="tab-pane" id="example-user-tabs-profile">
                <h5 class="page-header-sub hidden-phone">Image</h5>
                <div class="form-horizontal hidden-phone">
                    <div class="control-group">
                            <img src="img/placeholders/image_dark_120x120.png" alt="image">
                    </div>
                    <div class="control-group">
                        <form action="index.php" class="dropzone">
                            <div class="fallback">
                                <input name="file" type="file">
                            </div>
                        </form>
                    </div>
                </div>
                <form class="form-horizontal">
                    <h5 class="page-header-sub">Details</h5>
                    <div class="control-group">
                        <label class="control-label" for="example-user-firstname">Firstname</label>
                        <div class="controls">
                            <input type="text" id="example-user-firstname" value="John">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-user-lastname">Lastname</label>
                        <div class="controls">
                            <input type="text" id="example-user-lastname" value="Doe">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-user-gender">Gender</label>
                        <div class="controls">
                            <select id="example-user-gender">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-user-birthdate">Birthdate</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" id="example-user-birthdate" class="input-small input-datepicker">
                                <span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-user-skills">Skills</label>
                        <div class="controls">
                            <select id="example-user-skills" multiple="multiple" class="select-chosen">
                                <option selected>html</option>
                                <option selected>css</option>
                                <option>javascript</option>
                                <option>php</option>
                                <option>mysql</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-user-bio">Bio</label>
                        <div class="controls">
                            <textarea id="example-user-bio" class="textarea-elastic" rows="3">Bio Information..</textarea>
                        </div>
                    </div>
                    <h5 class="page-header-sub">Social</h5>
                    <div class="control-group">
                        <label class="control-label" for="example-user-fb">Facebook</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" id="example-user-fb">
                                <span class="add-on"><i class="icon-facebook"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-user-twitter">Twitter</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" id="example-user-twitter">
                                <span class="add-on"><i class="icon-twitter"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-user-pinterest">Pinterest</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" id="example-user-pinterest">
                                <span class="add-on"><i class="icon-pinterest"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-user-github">Github</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" id="example-user-github">
                                <span class="add-on"><i class="icon-github"></i></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Second Tab -->
        </div>
        <!-- END Tab Content -->
    </div>
    <!-- END Modal Content -->

    <!-- Modal footer -->
    <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i> Close</button>
        <button class="btn btn-success"><i class="icon-spinner icon-spin"></i> Save changes</button>
    </div>
    <!-- END Modal footer -->
</div>
<!-- END User Modal Settings -->

<!-- Excanvas for Flot (Charts plugin) support on IE8 -->
<!--[if lte IE 8]><script src="js/helpers/excanvas.min.js"></script><![endif]-->

<!-- Jquery library from Google ... -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- ... but if something goes wrong get Jquery from local file -->
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/vendor/jquery-1.9.1.min.js"%3E%3C/script%3E'));</script>

<!-- Bootstrap.js -->
<script src="js/vendor/bootstrap.min.js"></script>

<!--
Include Google Maps API for global use.
If you don't want to use  Google Maps API globally, just remove this line and the gmaps.js plugin from js/plugins.js (you can put it in a seperate file)
Then iclude them both in the pages you would like to use the google maps functionality
-->
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>

<!-- Jquery plugins and custom javascript code -->
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>