<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>XTREMEADMIN - Admin Template by Exepxon</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />
<link rel="stylesheet" media="screen" href="css/tables.css" />

<!-- jquerytools -->
<script src="js/jquery.tools.min.js"></script>
<script src="js/jquery.tables.js"></script>
<!--[if lt IE 9]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/selectivizr.js"></script>
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" media="screen" href="css/ie8.css" />
<![endif]-->

<script type="text/javascript" src="js/global.js"></script>

</head>
<body>
    
    <div id="wrapper">
        <header id="page-header">
            <div class="wrapper">
                <div id="util-nav">
                    <ul>
                        <li>Logged in as admin:</li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Account</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
                <h1>XTREMEADMIN</h1>
                <div id="main-nav">
                    <ul class="clearfix">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="styles.php">Styles</a></li>
                        <li><a href="forms.php">Forms</a></li>
                        <li class="active"><a href="tables.php">Tables</a></li>
                        <li><a href="grids.php">Grids</a></li>
                        <li><a href="media.php">Media</a></li>
                        <li><a href="pricing.php">Pricing Table</a></li>
                        <li id="quick-links">
                            <a href="#">Quick Links<span>&darr;</span></a>
                            <ul>
                                <li><a href="#">New Post</a></li>
                                <li><a href="#">Drafts</a></li>
                                <li><a href="#">Upload</a></li>
                                <li><a href="#">Comments</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="page-subheader">
                <div class="wrapper">
                    <h2>Tables</h2>
                    <input placeholder="Search..." type="text" name="q" value="" />
                </div>
            </div>
        </header>
        
        <section id="content">
            <div class="wrapper">

                <!-- Left column/section -->

                <section class="grid_6 first">

                    <div class="columns leading">
                        <div class="grid_6 first">
                            <h3>Table with pagination and sorting</h3>

                            <hr />

                            <table class="paginate sortable full">
                                <thead>
                                    <tr>
                                        <th>Browser</th>
                                        <th>Platform</th>
                                        <th>Table Cell</th>
                                        <th>Table Cell</th>
                                        <th>Table Cell</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Firefox 3.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>Ubuntu</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 6.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 7.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 7.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 6.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 7.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 8.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 9.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Safari 5.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Safari 5.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Opera 9.5</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>Ubuntu</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 6.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 7.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 7.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 6.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 7.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 8.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 9.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Safari 5.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Safari 5.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Opera 9.5</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>Ubuntu</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 6.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 7.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 7.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 6.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 7.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 8.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 9.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Safari 5.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Safari 5.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Opera 9.5</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox 3.6</td>
                                        <td>Ubuntu</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 6.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 7.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Chrome 7.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 6.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 7.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 8.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Internet Explorer 9.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Safari 5.0</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Safari 5.0</td>
                                        <td>OS X</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Opera 9.5</td>
                                        <td>Windows</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                        <td>Table Cell</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    
                    <div class="columns leading">
                        <div class="grid_6 first">
                            <h3>Usage</h3>

                            <hr />
                            <h4>Automatically enable pagination on a table</h4>
                            <p>To automatically paginate a table, add the <span class="code">paginate</span> class </p>
                            <h5>HTML</h5>
                            <code>
                                &lt;table class="paginate"&gt;<br />
                                &lt;/table&gt;
                            </code>
                            <h4>Manually enable pagination on a table</h4>
                            <h5>HTML</h5>
                            <code>
                                &lt;table class="mytableclass"&gt;<br />
                                &lt;/table&gt;
                            </code>
                            <h5>Add the following javascript</h5>
                            <code>
                                $(document).ready(function(){<br />
                                    $("table.mytableclass").paginate({rows: 10, buttonClass: 'button-blue'});<br />
                                });
                            </code>
                            <p><span class="code">rows</span>: The number of rows to show per page</p>
                            <p><span class="code">buttonClass</span>: button-gray, button-blue, button-green, button-orange</p>
                            <h4>Automatically enable sorting on a table</h4>
                            <p>To automatically allow column sorting on a table, add the <span class="code">sortable</span> class </p>
                            <h5>HTML</h5>
                            <code>
                                &lt;table class="sortable"&gt;<br />
                                &lt;/table&gt;
                            </code>
                            <h4>Manually enable sorting on a table</h4>
                            <h5>HTML</h5>
                            <code>
                                &lt;table class="mytableclass"&gt;<br />
                                &lt;/table&gt;
                            </code>
                            <h5>Add the following javascript</h5>
                            <code>
                                $(document).ready(function(){<br />
                                    $("table.mytableclass").tablesort();<br />
                                });
                            </code>
                        </div>
                    </div>
                                        
                    <div class="clear">&nbsp;</div>

                </section>

                <!-- End of Left column/section -->

                <!-- Right column/section -->

                <aside class="grid_2">

                    <div class="accordion top">

                        <h2 class="current">First pane</h2>
                        <div class="pane" style="display:block">... pane content ...</div>

                        <h2>Second pane</h2>
                        <div class="pane">... pane content ...</div>

                        <h2>Third pane</h2>
                        <div class="pane">... pane content ...</div>

                    </div>

                </aside>

                <!-- End of Right column/section -->
                <div class="clear"></div>

            </div>
            <div id="push"></div>
        </section>
    </div>
    
    <footer id="page-footer">
        <div id="footer-inner">
            <p class="wrapper"><span style="float: right;"><a href="#">Documentation</a> | <a href="#">Feedback</a></span>Last account activity from 127.0.0.1 - <a href="#">Details</a> | &copy; 2010. All rights reserved. Theme design by VivantDesigns</p>
        </div>
    </footer>

</body>

</html>