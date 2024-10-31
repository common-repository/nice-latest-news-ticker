<?php
/*
Plugin Name: Nice Latest News Ticker
Plugin URI: http://wordpress.org/plugins/nice-latest-news-ticker/
Description: Show Your News, Latest News, Breaking With this Ticker
Author: Nayeem Hyder
Version: 1.0
Author URI: http://www.nayeemriddhi.info/
*/

//For Metabox
include_once( plugin_dir_path( __FILE__ ) . '/library/metabox/metabox.php' );

include_once( plugin_dir_path( __FILE__ ) . '/library/metabox/cmb2-tabs/include-main.php' );
include_once( plugin_dir_path( __FILE__ ) . '/library/metabox/cmb2-tabs/functions.php' );

// For Plugin Functions
include_once( plugin_dir_path( __FILE__ ) . '/functions.php' );

// Frontend Shortcode Script
include_once( plugin_dir_path( __FILE__ ) . '/nice-news-shortcode.php' );


//Load Js file for plugin
function nice_ticker_plugin_main_js() {

     wp_enqueue_script( 'nice-latest-news-tickerjs', plugins_url( '/assets/js/news-ticker.js', __FILE__ ), array('jquery'), time(), true);

}  add_action('init','nice_ticker_plugin_main_js');


//Load Css file for plugin
function nice_ticker_plugin_main_css() {
   
    wp_enqueue_style( 'nice-latest-news-tickercss', plugins_url( '/assets/css/style.css', __FILE__ ));
    
} add_action('init','nice_ticker_plugin_main_css');







