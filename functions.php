<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.1.2' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700|Roboto+Slab:400,700,300 ', array(), CHILD_THEME_VERSION );

}

/** Remove footer widgets */
remove_theme_support( 'genesis-footer-widgets', 3 );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//Sydneys Footer
remove_action('genesis_footer', 'genesis_do_footer');
add_action('genesis_footer', 'sydneys_footer');

function sydneys_footer(){ ?>
<p>Copyright ©&nbsp;2015 · <a href="http://www.sydneyshealthmarket.com/">Sydney's Health Market</a> · Developed By <a href="http://www.katherineelsken.com/">Katherine Elsken</a> ·
<a href="/wp-login.php?action=logout&amp;_wpnonce=517b85bac7">Log out</a></p>	
	
<?php
	
}

/**********************************
 *
 * Replace Header Site Title with Inline Logo
 *
 * Fixes Genesis bug - when using static front page and blog page (admin reading settings) Home page is <p> tag and Blog page is <h1> tag
 *
 * Replaces "is_home" with "is_front_page" to correctly display Home page wit <h1> tag and Blog page with <p> tag
 *
 * @author AlphaBlossom / Tony Eppright
 * @link http://www.alphablossom.com/a-better-wordpress-genesis-responsive-logo-header/
 *
 * @edited by Sridhar Katakam
 * @link http://www.sridharkatakam.com/use-inline-logo-instead-background-image-genesis/
 *
************************************/
add_filter( 'genesis_seo_title', 'custom_header_inline_logo', 10, 3 );
function custom_header_inline_logo( $title, $inside, $wrap ) {
 
	$logo = '<img src="' . get_stylesheet_directory_uri() . '/images/app-logo.png" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" width="300" height="60" />';
 
	$inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $logo );
 
	// Determine which wrapping tags to use - changed is_home to is_front_page to fix Genesis bug
	$wrap = is_front_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';
 
	// A little fallback, in case an SEO plugin is active - changed is_home to is_front_page to fix Genesis bug
	$wrap = is_front_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;
 
	// And finally, $wrap in h1 if HTML5 & semantic headings enabled
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;
 
	return sprintf( '<%1$s %2$s>%3$s</%1$s>', $wrap, genesis_attr( 'site-title' ), $inside );
 
}

// Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'custom_scripts_styles_mobile_responsive' );
function custom_scripts_styles_mobile_responsive() {

	wp_enqueue_script( 'responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_style( 'dashicons' );
	

}

//Login stylesheet
function sydneys_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login.css" />';
}
add_action('login_head', 'sydneys_custom_login');

//Login Url

function sydneys_login_logo_url() {
return get_bloginfo( 'http://ordering-app-katstar01.c9.io' );
}
add_filter( 'login_headerurl', 'sydneys_login_logo_url' );

function sydneys_login_logo_url_title() {
return 'Sydneys Special Orders';
}
add_filter( 'login_headertitle', 'sydneys_login_logo_url_title' );

// Customize the previous page link
add_filter ( 'genesis_prev_link_text' , 'sp_previous_page_link' );
function sp_previous_page_link ( $text ) {
	return g_ent( '&laquo; ' ) . __( 'Previous Page', CHILD_DOMAIN );
}

// Customize the next page link
add_filter ( 'genesis_next_link_text' , 'sp_next_page_link' );
function sp_next_page_link ( $text ) {
	return __( 'Next Page', CHILD_DOMAIN ) . g_ent( ' &raquo; ' );
}

//* Customize search form input box text
add_filter( 'genesis_search_text', 'sp_search_text' );
function sp_search_text( $text ) {
	return esc_attr( 'Search for an order...' );
}

/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function be_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'be_remove_genesis_page_templates' );

//Load The Custom Order Post Type
include_once ('inc/order-post-type.php');

//Customer Post Type
include_once('inc/customer-post-type.php');

//Load Advanced Custom Fields Search Config
include_once('inc/acf-search.php');


//No sidebar Layout (not full width)
/**
 * Create Archive Layout
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-genesis-custom-layout/
 */
function be_create_nosidebar_layout() {
	 genesis_register_layout( 'no-sidebar', array(
		'label' => __('No Sidebar', 'genesis'),
		'img' => get_bloginfo('stylesheet_directory') . '/images/no-sidebar.gif'
	) );
}
add_action( 'init', 'be_create_nosidebar_layout' );

//hide dashboard for all users except admin
function remove_the_dashboard () {
if (current_user_can('level_10')) {
return;}else {
global $menu, $submenu, $user_ID;
$the_user = new WP_User($user_ID);
reset($menu); $page = key($menu);
while ((__('Dashboard') != $menu[$page][0]) && next($menu))
$page = key($menu);
if (__('Dashboard') == $menu[$page][0]) unset($menu[$page]);
reset($menu); $page = key($menu);
while (!$the_user->has_cap($menu[$page][1]) && next($menu))
$page = key($menu);
if (preg_match('#wp-admin/?(index.php)?$#',$_SERVER['REQUEST_URI']) && ('index.php' != $menu[$page][2]))
wp_redirect(get_option('siteurl') . '/wp-admin/post-new.php');}}
add_action('admin_menu', 'remove_the_dashboard');

add_filter('show_admin_bar','__return_false');


//widget areas
genesis_register_sidebar( array(
'id' => 'home-widget',
'name' => __( 'Home Widget', 'genesis' ),
'description' => __( 'Home Widget Area', 'Sydneys' ),
) );

/* Require Authentication for Intranet */

function my_force_login() {
global $post;

if (!is_user_logged_in()) {
    auth_redirect();
    }
}  