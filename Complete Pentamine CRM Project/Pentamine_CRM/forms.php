<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>PENTAMINE TECHNOLOGIES CUSTOMER RELATIONSHIP SYSTEM - Admin Panel</title>


<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/uniform.aristo.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />

<!-- jquerytools -->
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
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
<script> 
$(document).ready(function(){
    // Regular Expression to test whether the value is valid
    $.tools.validator.fn("[type=time]", "Please supply a valid time", function(input, value) { 
    	return /^\d\d:\d\d$/.test(value);
    });
     
    $.tools.validator.fn("[data-equals]", "Value not equal with the $1 field", function(input) {
    	var name = input.attr("data-equals"),
    		 field = this.getInputs().filter("[name=" + name + "]"); 
    	return input.val() == field.val() ? true : [name]; 
    });
     
    $.tools.validator.fn("[minlength]", function(input, value) {
    	var min = input.attr("minlength");
    	
    	return value.length >= min ? true : {     
    		en: "Please provide at least " +min+ " character" + (min > 1 ? "s" : "")
    	};
    });
     
    $.tools.validator.localizeFn("[type=time]", {
    	en: 'Please supply a valid time'
    });
     
     
    $("#form").validator({ 
    	position: 'left', 
    	offset: [25, 10],
    	messageClass:'form-error',
    	message: '<div><em/></div>' // em element is the arrow
    });

/**
 * Modal Dialog Boxes Setup
 */

    var triggers = $(".modalInput").overlay({

        // some mask tweaks suitable for modal dialogs
        mask: {
            color: '#ebecff',
            loadSpeed: 200,
            opacity: 0.7
        },

        closeOnClick: false
    });

    /* Simple Modal Box */
    var buttons = $("#simpledialog button").click(function(e) {
	
        // get user input
        var yes = buttons.index(this) === 0;

        if (yes) {
            // do the processing here
        }
    });

    /* Yes/No Modal Box */
    var buttons = $("#yesno button").click(function(e) {
	
        // get user input
        var yes = buttons.index(this) === 0;

        // do something with the answer
        triggers.eq(0).html("You clicked " + (yes ? "yes" : "no"));
    });

    /* User Input Prompt Modal Box */
    $("#prompt form").submit(function(e) {

        // close the overlay
        triggers.eq(1).overlay().close();

        // get user input
        var input = $("input", this).val();

        // do something with the answer
        if (input) triggers.eq(1).html(input);

        // do not submit the form
        return e.preventDefault();
    });
});
    
</script> 
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
                        <li class="active"><a href="forms.php">Forms</a></li>
                        <li><a href="tables.php">Tables</a></li>
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
                    <h2>Forms</h2>
                    <input placeholder="Search..." type="text" name="q" value="" />
                </div>
            </div>
        </header>
        
        <section id="content">
            <div class="wrapper">

                <!-- Left column/section -->

                <section class="grid_6 first">

                    <div class="columns">
                        <div class="grid_6 first">
                            <h3>Modal Dialogs</h3>
                            <hr />
                            <!-- the triggers -->
                            <p>
                                <button class="modalInput button button-green" rel="#simpledialog">Simple Dialog</button>
                                <button class="modalInput button button-blue" rel="#yesno">Yes or no?</button>
                                <button class="modalInput button button-orange" rel="#prompt">User input</button>
                            </p>

                            <!-- simple dialog -->
                            <div class="widget modal" id="simpledialog">
                                <header><h2>This is a simple modal dialog</h2></header>
                                <section>
                                    <p>
                                        Are you sure you want to do this?
                                    </p>

                                    <!-- yes/no buttons -->
                                    <p>
                                        <button class="button button-blue close"> Yes </button>
                                        <button class="button button-gray close"> No </button>
                                    </p>
                                </section>
                            </div>

                            <!-- yes/no dialog -->
                            <div class="widget modal" id="yesno">
                                <header><h2>This is a modal dialog</h2></header>
                                <section>
                                    <p>
                                        You can only interact with elements that are inside this dialog.
                                        To close it click a button or use the ESC key.
                                    </p>

                                    <!-- yes/no buttons -->
                                    <p>
                                        <button class="button button-blue close">Yes</button>
                                        <button class="button button-gray close">No</button>
                                    </p>
                                </section>
                            </div>


                            <!-- user input dialog -->
                            <div class="widget modal" id="prompt">
                                <header><h2>This is a modal dialog</h2></header>
                                <section>
                                    <p>
                                        You can only interact with elements that are inside this dialog.
                                        To close it click a button or use the ESC key.
                                    </p>

                                    <!-- input form. you can press enter too -->
                                    <form>
                                        <input type="text" />
                                        <hr />
                                        <button class="button button-gray" type="submit">OK</button>
                                        <button class="button button-gray close" type="button">Cancel</button>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="grid_6 first">
                        	<form id="form" class="form panel">
                                <header><h2>HTML5 form with validation</h2></header>
                                <hr />
                                <fieldset>
                                    <div class="clearfix">
                                        <label>email *</label><input type="email" required="required" />
                                    </div>
                                    <div class="clearfix">
                                        <label>username *</label><input type="text" name="username" required="required" />
                                    </div>
                                    <div class="clearfix">
                                        <label>Password</label><input type="password" name="password" />
                                    </div>
                                    <div class="clearfix">
                                        <label>Password check</label><input type="password" name="check" data-equals="password" />
                                    </div>
                                    <div class="clearfix">
                                        <label>website *</label><input type="url" required="required" />
                                    </div>
                                    <div class="clearfix">
                                        <label>name *</label><input type="text" name="name" required="required" />
                                    </div>
                                    <div class="clearfix">
                                        <label>age</label><input type="number" name="age" value="0" />
                                    </div>
                                    <div class="clearfix">
                                        <label>time *</label><input type="time" name="time" />
                                    </div>
                                    <div class="clearfix">
                                        <label>Select</label><select><option>Lorem</option><option>Dolor</option><option>Sit amet</option></select>
                                    </div>
                                    <div class="clearfix">
                                        <label>Textarea</label><textarea rows="5" cols="90"></textarea>
                                    </div>
                                    <div class="clearfix">
                                        <label>datepicker</label><input type="date" name="date" />
                                    </div>
                                    <div class="clearfix">
                                        <label>radio button</label><span class="radio-input"><input type="radio" name="radio" />Radio 1</span> <span class="radio-input"><input type="radio" name="radio" />Radio 2</span>
                                    </div>
                                    <div class="clearfix">
                                        <label>Checkbox</label><input type="checkbox" checked="checked"/>
                                    </div>
                                </fieldset>
                                <hr />
                                <button class="button button-green" type="submit">Submit form</button>
                                <button class="button button-gray" type="reset">Reset</button>
                            </form>
                        </div>
                    </div>

                    <div class="columns leading">
                        <div class="grid_6 first">
                            <h3>Tabs</h3>

                            <hr />

                            <!-- the tabs -->
                            <div class="tabbed-pane">
                                <ul class="tabs">
                                    <li><a href="#">Tab 1</a></li>
                                    <li><a href="#">Tab 2</a></li>
                                    <li><a href="#">Tab 3</a></li>
                                </ul>

                                <!-- tab "panes" -->
                                <div class="panes">
                                    <div><h4>First tab content.</h4> Tab contents are called "panes"</div>
                                    <div>Second tab content</div>
                                    <div>Third tab content</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="columns leading">
                        <div class="grid_6 first">
                            <h3>Widgets</h3>
                            <hr />

                            <div class="widget">
                                <header><h2>Widget</h2></header>
                                <section>
                                    <p>This is a normal widget</p>
                                </section>
                            </div>

                            <div class="panel">
                                <header><h2>Panel Widget</h2></header>
                                <section>
                                    <p>This is a panel widget</p>
                                </section>
                            </div>
                        </div>
                    </div>

                    <div class="clear">&nbsp;</div>

                </section>

                <!-- End of Left column/section -->

                

                <!-- Right column/section -->

                <aside class="grid_2">

                    <div class="accordion top">

                        <h2 class="current">Modal Dialogs</h2>
                        <div class="pane" style="display:block">
                            <ul>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/overlay/modal-dialog.html">Creating Modal Dialogs with Overlay</a></li>
                            </ul>
                        </div>

                        <h2>jQuery Tools Validator</h2>
                        <div class="pane">
                            <ul>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/index.html">Minimal setup</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/custom-validators.html">Custom input types and attributes</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/server-side.html">Combined server and client-side validation</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/custom-effect.html">Displaying all errors inside a single DIV</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/events.html">Validator events in action</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/localize.html">Localizing the validator (Finnish)</a></li>
                            </ul>
                        </div>

                        <h2>jQuery Tools Tabs</h2>
                        <div class="pane">
                            <ul>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/index.html">Minimal setup</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/anchors.html#second">Naming the tabs</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/skins.html">4 different skins with CSS</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/mouseover.html">Using mouseover to switch tabs</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/wizard.html">Making Wizards with the tabs</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/accordion.html">Making Accordions with the tabs</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/accordion-custom.html">Customizing the Accordion effect</a></li>
                            </ul>
                        </div>

                        <h2>jQuery Tools Dateinput</h2>
                        <div class="pane">
                            <ul>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/index.html">Minimal setup</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/large-skin.html">Large skin for Dateinput</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/customize.html">Customizing Dateinput behaviour</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/flight.html">Prompting for start and end dates</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/static.html">Calendar that is always visible</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/localize.html">Localizing the Dateinput</a></li>
                            </ul>
                        </div>

                        <h2>Documentation</h2>
                        <div class="pane">
                            <ul>
                                <li><a target="_blank" href="http://www.jquery.org/">jQuery</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/overlay/index.html">jQuery Tools Overlay</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/validator/index.html">jQuery Tools Validator</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/tabs/index.html">jQuery Tools Tabs</a></li>
                            </ul>
                        </div>

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

