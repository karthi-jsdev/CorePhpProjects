<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from themes.vivantdesigns.com/xtremeadmin/media.html by HTTrack Website Copier/3.x [XR&CO'2008], Fri, 06 Jul 2012 09:23:03 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>XTREMEADMIN - Admin Template by Exepxon</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />
<link rel="stylesheet" media="screen" href="css/media.css" />

<!-- jquerytools -->
<script src="js/jquery.tools.min.js"></script>
<!--[if lt IE 9]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/selectivizr.js"></script>
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" media="screen" href="css/ie8.css" />
<![endif]-->

<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.quicksand.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script>
$(document).ready(function(){
    $(".scrollable").scrollable();
    $(".items img").click(function() {
        if ($(this).hasClass("active")) { return; }
        var url = $(this).attr("src").replace("_t", "");
        var wrap = $("#image_wrap").fadeTo("medium", 0.5);
        var img = new Image();
        img.onload = function() {
            wrap.fadeTo("fast", 1);
            wrap.find("img").attr("src", url);
        };
        img.src = url;
        $(".items img").removeClass("active");
        $(this).addClass("active");
    }).filter(":first").click();

    $("a[rel]").overlay({

        effect: 'apple',

        onBeforeLoad: function() {

            // grab wrapper element inside content
            var wrap = this.getOverlay().find(".contentWrap");

            // load the page specified in the trigger
            wrap.html('<img src="'+this.getTrigger().attr("href")+'" />');
        }

    });
});
/*
 * Splitter
 */
(function($) {
	$.fn.sorted = function(customOptions) {
		var options = {
			reversed: false,
			by: function(a) {
				return a.text();
			}
		};
		$.extend(options, customOptions);
	
		$data = $(this);
		arr = $data.get();
		arr.sort(function(a, b) {
			
		   	var valA = options.by($(a));
		   	var valB = options.by($(b));
			if (options.reversed) {
				return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
			} else {		
				return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
			}
		});
		return $(arr);
	};

})(jQuery);

$(function() {
  
  var read_button = function(class_names) {
    var r = {
      selected: false,
      type: 0
    };
    for (var i=0; i < class_names.length; i++) {
      if (class_names[i].indexOf('selected-') == 0) {
        r.selected = true;
      }
      if (class_names[i].indexOf('segment-') == 0) {
        r.segment = class_names[i].split('-')[1];
      }
    };
    return r;
  };
  
  var determine_sort = function($buttons) {
    var $selected = $buttons.parent().filter('[class*="selected-"]');
    return $selected.find('a').attr('data-value');
  };
  
  var determine_kind = function($buttons) {
    var $selected = $buttons.parent().filter('[class*="selected-"]');
    return $selected.find('a').attr('data-value');
  };
  
  var $preferences = {
    duration: 800,
    easing: 'easeInOutQuad',
    adjustHeight: false
  };
  
  var $list = $('#list');
  var $data = $list.clone();
  
  var $controls = $('ul.splitter ul');
  
  $controls.each(function(i) {
    
    var $control = $(this);
    var $buttons = $control.find('a');
    
    $buttons.bind('click', function(e) {
      
      var $button = $(this);
      var $button_container = $button.parent();
      var button_properties = read_button($button_container.attr('class').split(' '));      
      var selected = button_properties.selected;
      var button_segment = button_properties.segment;

      if (!selected) {

        $buttons.parent().removeClass('selected-0').removeClass('selected-1').removeClass('selected-2').removeClass('selected-3');
        $button_container.addClass('selected-' + button_segment);
        
        var sorting_type = determine_sort($controls.eq(1).find('a'));
        var sorting_kind = determine_kind($controls.eq(0).find('a'));
        
        if (sorting_kind == 'all') {
          var $filtered_data = $data.find('li');
        } else {
          var $filtered_data = $data.find('li.' + sorting_kind);
        }
        
        if (sorting_type == 'size') {
          var $sorted_data = $filtered_data.sorted({
            by: function(v) {
              return parseFloat($(v).find('span').text());
            }
          });
        } else {
          var $sorted_data = $filtered_data.sorted({
            by: function(v) {
              return $(v).find('strong').text().toLowerCase();
            }
          });
        }
        
        $list.quicksand($sorted_data, $preferences);
        
      }
      
      e.preventDefault();
    });
    
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
                        <li><a href="forms.php">Forms</a></li>
                        <li><a href="tables.php">Tables</a></li>
                        <li><a href="grids.php">Grids</a></li>
                        <li class="active"><a href="media.php">Media</a></li>
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
                    <h2>Media</h2>
                    <input placeholder="Search..." type="text" name="q" value="" />
                </div>
            </div>
        </header>
        
        <section id="content">
            <div class="wrapper">

                <!-- Main Section -->

                <section class="column grid_6 first">

                    <div class="columns leading">
                        <div class="grid_6 first">
                            <h3>Overlays</h3>
                            <hr />
                            <p>Click on an image to view the overlay</p>
                            <a href="images/autumn/scottwills_autumn2.jpg" rel="#overlay"><img src="images/autumn/scottwills_autumn2_t.jpg" rel="#photo1" /></a>
                            <a href="images/autumn/scottwills_autumn4.jpg" rel="#overlay"><img src="images/autumn/scottwills_autumn4_t.jpg" /></a>
                            <a href="images/autumn/scottwills_autumn5.jpg" rel="#overlay"><img src="images/autumn/scottwills_autumn5_t.jpg" /></a>
                            <a href="images/autumn/scottwills_autumn6.jpg" rel="#overlay"><img src="images/autumn/scottwills_autumn6_t.jpg" /></a>
                            <a href="images/autumn/scottwills_autumnleaf.jpg" rel="#overlay"><img src="images/autumn/scottwills_autumnleaf_t.jpg" /></a>
                            <a href="images/autumn/scottwills_butterfly.jpg" rel="#overlay"><img src="images/autumn/scottwills_butterfly_t.jpg" /></a>
                            <a href="images/autumn/scottwills_farmhouse2.jpg" rel="#overlay"><img src="images/autumn/scottwills_farmhouse2_t.jpg" /></a>

                            <!-- overlayed element -->
                            <div class="apple_overlay black" id="overlay">

                                <!-- the external content is loaded inside this tag -->
                                <div class="contentWrap"></div>

                            </div>
                        </div>
                    </div>
					 
					<div class="columns leading">
                        <div class="grid_6 first">
                            <h3>Image Gallery</h3>
                            <hr />
                            <!-- wrapper element for the large image -->
                            <div id="image_wrap">
                            
                                <!-- Initially the image is a simple 1x1 pixel transparent GIF -->
                                <img src="images/blank.gif" width="630" height="472" />
                            
                            </div>

                            <!-- "previous page" action -->
                            <a class="prev browse left button button-round button-gray">&laquo;</a>
                            
                            <!-- root element for scrollable -->
                            <div class="scrollable">   
                               
                               <!-- root element for the items -->
                               <div class="items">
                               
                                  <!-- 1-5 -->
                                  <div>
                                     <img src="images/autumn/adfish_falltrees2_t.jpg" />
                                     <img src="images/autumn/adfish_falltrees5_t.jpg" />
                                     <img src="images/autumn/adfish_falltrees_t.jpg" />
                                     <img src="images/autumn/scottwills_autumn2_t.jpg" />
                                     <img src="images/autumn/scottwills_autumn4_t.jpg" />
                                  </div>
                                  
                                  <!-- 5-10 -->
                                  <div>
                                     <img src="images/autumn/scottwills_autumn5_t.jpg" />
                                     <img src="images/autumn/scottwills_autumn6_t.jpg" />
                                     <img src="images/autumn/scottwills_autumnleaf_t.jpg" />
                                     <img src="images/autumn/scottwills_butterfly_t.jpg" />
                                     <img src="images/autumn/scottwills_farmhouse2_t.jpg" />
                                  </div>
                                  
                               </div>
                               
                            </div>
                            
                            <!-- "next page" action -->
                            <a class="next browse right button button-round button-gray">&raquo;</a>

                        </div>
                    </div>
                    
                    <div class="columns leading">
                        <div class="grid_6 first">
                        	<form id="filter">
	                        	<ul  class="splitter">
	                        		<li>Filter by type:
	                        			<ul name="type">
	                        				<li class="segment-1 selected-1"><a href="#" data-value="all">All</a></li>
	                        				<li class="segment-0"><a href="#" data-value="art">Art Icons</a></li>
	                        				<li class="segment-2"><a href="#" data-value="payment">Payment Icons</a></li>
	                        				<li class="segment-3"><a href="#" data-value="social">Social Icons</a></li>
	                        			</ul>
	                        		</li>
	                        		<li>Sort by:
	                        			<ul name="sort">
	                        				<li class="segment-1 selected-1"><a href="#" data-value="name">Name</a></li>
	                        				<li class="segment-2"><a href="#" data-value="size">Size</a></li>
	                        			</ul>
	                        		</li>
	                        	</ul>
                        	</form>
                            <h3>Image Gallery</h3>
                            <hr />
                          	<p>Reorder and filter items with a nice shuffling animation.</p>
                          	<div class="demo">
                          		<ul id="list" class="image-grid"> 
						            <li data-id="id-1" class="art"> 
						              <img src="images/splitter/motiongraphic.png" width="128" height="128" alt="" /> 
						              <strong>Motion Graphic</strong> 
						              <span>108 KB</span> 
						            </li> 
						            <li data-id="id-2" class="art"> 
						              <img src="images/splitter/painting.png" width="128" height="128" alt="" /> 
						              <strong>Paiting</strong>
						              <span>100 KB</span> 
						            </li> 
						            <li data-id="id-3" class="payment"> 
						              <img src="images/splitter/paypal.png" width="128" height="128" alt="" /> 
						              <strong>PayPal</strong> 
						              <span>16 KB</span> 
						            </li> 
						            <li data-id="id-4" class="social"> 
						              <img src="images/splitter/facebook.png" width="128" height="128" alt="" /> 
						              <strong>Facebook</strong> 
						              <span>56 KB</span> 
						            </li> 
						            <li data-id="id-5" class="payment"> 
						              <img src="images/splitter/check.png" width="128" height="128" alt="" /> 
						              <strong>Check</strong> 
						              <span>12875 KB</span> 
						            </li> 
						            <li data-id="id-6" class="art"> 
						              <img src="images/splitter/coding.png" width="128" height="128" alt="" /> 
						              <strong>Coding</strong> 
						              <span>508 KB</span> 
						            </li> 
						            <li data-id="id-7" class="art"> 
						              <img src="images/splitter/illustrations.png" width="128" height="128" alt="" /> 
						              <strong>Illustrations</strong> 
						              <span>196 KB</span> 
						            </li> 
						            <li data-id="id-8" class="payment"> 
						              <img src="images/splitter/mastercard.png" width="128" height="128" alt="" /> 
						              <strong>Master Card</strong> 
						              <span>172 KB</span> 
						            </li> 
						            <li data-id="id-9" class="art"> 
						              <img src="images/splitter/photography.png" width="128" height="128" alt="" /> 
						              <strong>Photography</strong> 
						              <span>172 KB</span> 
						            </li>
						            <li data-id="id-10" class="art"> 
						              <img src="images/splitter/photomanip.png" width="128" height="128" alt="" /> 
						              <strong>Photo Manipulation</strong> 
						              <span>960 KB</span> 
						            </li>
						            <li data-id="id-11" class="social"> 
						              <img src="images/splitter/rss.png" width="128" height="128" alt="" /> 
						              <strong>RSS</strong> 
						              <span>172 KB</span> 
						            </li>
						            <li data-id="id-12" class="art"> 
						              <img src="images/splitter/skinart.png" width="128" height="128" alt="" /> 
						              <strong>Skin Art</strong> 
						              <span>130 KB</span> 
						            </li>
						            <li data-id="id-13" class="social"> 
						              <img src="images/splitter/stumble_upon.png" width="128" height="128" alt="" /> 
						              <strong>Stumble Upon</strong> 
						              <span>49 KB</span> 
						            </li>
						            <li data-id="id-14" class="payment"> 
						              <img src="images/splitter/visa.png" width="128" height="128" alt="" /> 
						              <strong>Visa</strong> 
						              <span>109 KB</span> 
						            </li>  
						          </ul>
					        </div>
                        </div>
                    </div>
                    <div class="clear">&nbsp;</div>

                </section>

                <!-- Main Section End -->

                <!-- Sidebar -->

                <aside class="column grid_2">

                    <div class="accordion top leading">

                        <h2 class="current">jQuery Tools Overlay</h2>
                        <div class="pane" style="display:block">
                            <ul>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/overlay/index.html">Minimal setup</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/overlay/apple.html">The Apple effect for overlay</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/overlay/modal-dialog.html">Creating modal dialogs with overlay</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/overlay/trigger.html">Opening overlays programatically</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/overlay/styling.html">Overlays with different styles</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/overlay/external.html">Loading external pages into overlay</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/overlay/multiple.html">Multiple overlays on a same page</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/overlay/custom-effect.html">Creating a customized overlay effect</a></li>
                            </ul>
                        </div>

                        <h2>jQuery Tools Scrollable</h2>
                        <div class="pane">
                            <ul>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/scrollable/index.html">Minimal setup</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/scrollable/vertical.html">Vertical scrollable</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/scrollable/gallery.html">Simple scrollable image gallery</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/scrollable/multiple-scrollables.html">Another gallery with many scrollables</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/scrollable/wizard.html">A scrollable registration wizard</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/scrollable/plugins/index.html">Scrollable plugins in action</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/demos/scrollable/one-sized.html">Navigation with browser's back button</a></li>
                            </ul>
                        </div>

                        <h2>Documentation</h2>
                        <div class="pane">
                            <ul>
                                <li><a target="_blank" href="http://www.jquery.org/">jQuery</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/overlay/index.html">jQuery Tools Overlay</a></li>
                                <li><a target="_blank" href="http://flowplayer.org/tools/scrollable/index.html">jQuery Tools Scrollable</a></li>
                                <li><a target="_blank" href="http://razorjack.net/quicksand/">jQuery Quicksand</a></li>
                            </ul>
                        </div>

                    </div>

                </aside>

                <!-- Sidebar End -->
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

<!-- Mirrored from themes.vivantdesigns.com/xtremeadmin/media.html by HTTrack Website Copier/3.x [XR&CO'2008], Fri, 06 Jul 2012 09:23:47 GMT -->
</html>
