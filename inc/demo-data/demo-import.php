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

// demo import file
function winter_import_files() {
	
	$demoImg = '<img src="'.plugins_url( 'screen-image.jpg', __FILE__ ) .'" alt="'.esc_attr__( 'Demo Preview Imgae', 'winter-companion' ).'" />';
	
  return array(
    array(
      'import_file_name'             => 'Winter Demo',
      'local_import_file'            => WINTER_COMPANION_DEMO_DIR_PATH .'winter-demo.xml',
      'local_import_widget_file'     => WINTER_COMPANION_DEMO_DIR_PATH .'winter-widgets-demo.wie',
      'import_customizer_file_url'   => plugins_url( 'winter-customizer.dat', __FILE__ ),
      'import_notice' => $demoImg,
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'winter_import_files' );
	
// demo import setup
function winter_after_import_setup() {
	// Assign menus to their locations.
	$main_menu    = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$company_menu = get_term_by( 'name', 'Company', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu' => $main_menu->term_id,
			'company-menu' => $company_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Homepage' );
    $blog_page_id  = get_page_by_title( 'Blog' );
	$shop_page_id  = get_page_by_title( 'Shop' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', absint( $front_page_id->ID ) );
	update_option( 'page_for_posts', absint( $blog_page_id->ID ) );
    update_option( 'woocommerce_shop_page_id', absint( $shop_page_id->ID ) );
    update_option( 'winter_demodata_import', 'yes' );

}
add_action( 'pt-ocdi/after_import', 'winter_after_import_setup' );

//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function winter_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'winter-companion' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'winter-companion' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'winter-demo-import';


	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'winter_import_plugin_page_setup' );

// Enqueue scripts
function winter_demo_import_custom_scripts(){
	
	
	if( isset( $_GET['page'] ) && $_GET['page'] == 'winter-demo-import' ){
		// style
		wp_enqueue_style( 'winter-demo-import', plugins_url( 'css/demo-import.css', __FILE__ ), array(), '1.0', false );
	}
	
	
}
add_action( 'admin_enqueue_scripts', 'winter_demo_import_custom_scripts' );



?>