<?php
/*
Plugin Name: Widgets for Page Builder SiteOrigin and Genesis Framework
Plugin URI: https://github.com/closemarketing/genesis-so-widgets
Description: Widgets Page Builder SiteOrigin for Genesis Framework
Author: closemarketing
Author URI: https://www.closemarketing.es
Version: 0.4
Text Domain: widgets-so-genesis
Domain Path: /languages
License: GNU General Public License version 3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

//Loads translation
load_plugin_textdomain('widgets-so-genesis', false, dirname( plugin_basename( __FILE__ ) ). '/languages/');

//Widgets
require_once( dirname(__FILE__) . '/widgets/social-icons.php'); // Social Icons
require_once( dirname(__FILE__) . '/widgets/childmenu.php'); // Child Menu
require_once( dirname(__FILE__) . '/widgets/contactinfo.php'); // Contact info
require_once( dirname(__FILE__) . '/widgets/latestimgposts.php'); // Latest posts with image
require_once( dirname(__FILE__) . '/widgets/buttoncta.php'); // Button CTA for genesis
require_once( dirname(__FILE__) . '/widgets/woocatimg.php'); // WooCommerce Category Image
require_once( dirname(__FILE__) . '/widgets/buttios.php'); // Button Download ios
require_once( dirname(__FILE__) . '/widgets/buttand.php'); // Button Download Android
