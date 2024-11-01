<?php
/*
Plugin Name: WP-feedTicker
Plugin URI: http://jonmifsud.com/web-tools/wp-feedticker/
Description: To display a feedticker by feed in your page/post/template
Author: Jonathan Mifsud
Author URI: http://jonmifsud.com/
Version: 1.0
*/

/*
 *
 * How to use
 * =============================================================================
 * just put this shortcode in your post or pages
 *
 *    [feedticker num="3" feed="http://jonmifsud.com/rss/" id="feedticker", direction="1", speed="0.05", link="yes" ]
 *
 *	If used in a template please include the shortcode function
 *    do_shortcode('[feedticker num="3" feed="http://jonmifsud.com/rss/" id="feedticker", direction="1", speed="0.05", link="yes" ]');
 *
 * num 			- your total number of post to display. default is 10
 * category		- category id. use comma , for multiple id
 * orderby 		- your post will order by . default post_date . check http://codex.wordpress.org/Template_Tags/get_posts for detail
 * id			- the id that you would like to give to the feedticker list (has to be used when running multiple tickers on same page)
 * speed 		- the speed should be in the domain of 0 - 1 
 * direction	- 1 = left to right; and -1 = right to left.
 * link			- yes = link back to author site; hide = hide link; no = remove link completely. If you remove the link it would be appriciated if you write something about this plugin.
 *
 * style at your own
 * =============================================================================
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
ul.newsticker { // that's your list 
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
 
 */

function feedticker_func($atts) {
    extract(shortcode_atts(array(
            'id'    		=> 'feedticker',
            'num'    		=> '10',
            'feed'    		=> 'http://jonmifsud.com/rss/',
            'orderby'     	=> 'post_date',
            'speed'       	=> '0.05',
            'direction'   	=> '1',
			'link'			=>	'yes'
            ), $atts));

    $output = '<ul id="'.$id.'">';
    
	$rss = fetch_feed($feed);
	if (!is_wp_error( $rss ) ) { // Checks that the object is created correctly 
		// Figure out how many total items there are, but limit it to 5. 
		$maxitems = $rss->get_item_quantity($num); 

		// Build an array of all the items, starting with element 0 (first element).
		$rss_items = $rss->get_items(0, $maxitems); 
	}
	
	if ($maxitems == 0) $output .= '<li>No items</li>';
    foreach ( $rss_items as $item ) {
        $output .= '<li><a href="'. $item->get_permalink().'">'.esc_html( $item->get_title() ).'</a></li>';
    };
    if ($link != 'no') $output .= '<li id="wp-feedticker-link"><a href="http://jonmifsud.com/web-tools/wp-feedticker/">WP feedticker</a></li>';
    $output .= '</ul>';
	if ($link == 'hide') $output .= "<script>jQuery(document).ready(function(){jQuery('#wp-feedticker-link').hide});</script>";
	$output .= "<script>jQuery(document).ready(function(){jQuery.fx.off=false;jQuery('#".$id."').webTicker({direction: {$direction},travelocity: {$speed}});});</script>";
    return $output;
}

function init_feedticker(){
	if ( !is_admin() ) { // instruction to only load if it is not the admin area
	   // register your script location, dependencies and version
	   
		/*wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
		wp_enqueue_script( 'jquery' );*/
		 wp_enqueue_script('webticker',	 plugins_url('/jquery.webticker.js', __FILE__),  array('jquery'),'1.3' );
	}
}

add_action('init', 'init_feedticker');
add_shortcode('feedticker', 'feedticker_func');

?>
