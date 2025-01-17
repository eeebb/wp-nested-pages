<?php
/*
Plugin Name: Nested Pages
Plugin URI: http://nestedpages.com
Description: Provides an intuitive drag and drop interface for managing pages in the Wordpress admin, while maintaining quick edit functionality.
Version: 1.5.0
Author: Kyle Phillips
Author URI: https://github.com/kylephillips
Text Domain: nestedpages
Domain Path: /languages/
License: GPLv2 or later.
Copyright: Kyle Phillips
*/

/*  Copyright 2015 Kyle Phillips  (email : support@nestedpages.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
    
/**
* Check Wordpress and PHP versions before instantiating plugin
*/
register_activation_hook( __FILE__, 'nestedpages_check_versions' );
function nestedpages_check_versions( $wp = '3.9', $php = '5.3.2' ) {
    global $wp_version;
    if ( version_compare( PHP_VERSION, $php, '<' ) ) $flag = 'PHP';
    elseif ( version_compare( $wp_version, $wp, '<' ) ) $flag = 'WordPress';
    else return;
    $version = 'PHP' == $flag ? $php : $wp;
    
    if (function_exists('deactivate_plugins')){
        deactivate_plugins( basename( __FILE__ ) );
    }
    
    wp_die('<p>The <strong>Nested Pages</strong> plugin requires'.$flag.'  version '.$version.' or greater.</p>','Plugin Activation Error',  array( 'response'=>200, 'back_link'=>TRUE ) );
}

define('NESTEDPAGES_DIR', __FILE__);

if( !class_exists('Bootstrap') ) :
    nestedpages_check_versions();
    require_once('vendor/autoload.php');
    require_once('app/NestedPages.php');
    require_once('app/functions.php');
    NestedPages::init();
endif;