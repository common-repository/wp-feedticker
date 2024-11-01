=== WP-feedTicker ===
Contributors: gunglien
Plugin URI: http://jonmifsud.com/web-tools/wp-feedticker/
Tags: webticker, ticker, rotating, marquee, feedticker
Author: Jonathan Mifsud
Author URI: http://jonmifsud.com/
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: trunk
Version: 1.0

Display a rotating list of latest post in a particular category using shortcode.

== Description ==

wp-feedTicker is a plugin that provides shortcode functionality to use the jQuery webTicker.

The jQuery webTicker is a jQuery plugin that creates a ticker effect where posts slide from one side to another in a particular order
once the last item goes outside of the visible area it is queued back so that it will appear when the list finishes. The ticker can be used 
to show the users the latest posts in your blog/website without having space consuming widgets on the sidebars.

This makes creating web tickers on your wordpress blog quite easily. You can either use the shortcode in Advanced Text 
widget plugin; or else include it in a post/page or in the template itself using do_shortcode.

Further information and an example can be found on the official [wp-feedticker page](http://jonmifsud.com/web-tools/wp-feedticker/ "Wordpress feedTicker").

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `wp-feedticker` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add ticker styling in your CSS
4. Place `<?php do_shortcode('[feedticker]'); ?>` in your templates or [feedticker] in your posts/pages

= CSS Styling =


  * you need to style your wp-feedticker plugin in your style.css example

.tickeroverlay-left{
	background-image:url('left.png');
	display:block;
	pointer-events:none;
	position:absolute;
	z-index:30;
	height:12px;
	width:150px;
	top:0;
	left:-2px;
}
	
.tickeroverlay-right{
	background-image:url('right.png');
	display:block;
	pointer-events:none;
	position:absolute;
	z-index:30;
	height:12px;
	width:150px;
	top:0;
	right:-2px;
}

.tickercontainer { // the outer div 
	background: #7a7a7a; 
	width: 738px; 
	height: 27px; 
	margin: 0; 
	padding: 0;
	overflow: hidden; 
}

.tickercontainer .mask { // that serves as a mask. so you get a sort of padding both left and right 
	position: relative;
	padding-left: 10px;
	padding-right: 10px;
	top: 8px;
	height: 18px;
	overflow: hidden;
}

ul.newsticker {
	position: relative;
	margin-left: 20px;
	font: bold 10px Verdana;
	list-style-type: none;
	margin: 0;
	padding: 0;
}

ul.newsticker li {
	float: left; // important so they rotate properly
	margin: 0;
	padding-right: 15px;
}

ul.newsticker a {
	white-space: nowrap;
	padding: 0;
	color: #ff0000;
	font: bold 10px Verdana;
	margin: 0 50px 0 0;
} 

ul.newsticker span {
	margin: 0 10px 0 0;
} 

= How to use =

Add the following shortcode in your post/page)

[feedticker num="3" rss="http://yourwebsite.com/rss/" id="webticker", direction="1", speed="0.05" ]


If used in a template please include the shortcode function
 
do_shortcode('[feedticker num="3" category="http://yourwebsite.com/rss/" id="webticker", direction="1", speed="0.05", link="yes" ]');

 * num 			- your total number of post to display. default is 10
 * category		- category id. use comma , for multiple id
 * orderby 		- your post will order by . default post_date . check http://codex.wordpress.org/Template_Tags/get_posts for detail
 * id			- the id that you would like to give to the feedticker list (has to be used when running multiple tickers on same page)
 * speed 		- the speed should be in the domain of 0 - 1 
 * direction	- 1 = left to right; and -1 = right to left.
 * link			- yes = link back to author site; hide = hide link; no = remove link completely. 
 
 If you remove the link it would be appriciated if you write something about this plugin.

== Frequently Asked Questions ==

= Ticker does not work after adding shortcode =

Check that you have included the required CSS styling for the ticker to be able to work properly - see installation

= I Have a problem not listed here =

Kindly contact the author on info@jonmifsud.com and I will promptly reply and help you out where possible.

== Changelog ==
= 1.0 =
* Added version 1.0
* Added readme.txt

== Upgrade Notice ==

= 1.0 =
First public version of wp-feedticker - uses more stable jQuery webTicker v1.3
