<?php 
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Winter Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */

// Sidebar widgets include
require_once WINTER_COMPANION_SW_DIR_PATH . 'winter-newsletter-widget.php';
require_once WINTER_COMPANION_SW_DIR_PATH . 'winter-instagram.php';
require_once WINTER_COMPANION_SW_DIR_PATH . 'winter-recent-post-thumb.php';
require_once WINTER_COMPANION_SW_DIR_PATH . 'winter-social-links.php';

// Include Files
require_once WINTER_COMPANION_INC_DIR_PATH . 'functions.php';
require_once WINTER_COMPANION_EW_DIR_PATH  . 'elementor-widget.php';

// Demo import include
require_once WINTER_COMPANION_DEMO_DIR_PATH . 'demo-import.php';

?>