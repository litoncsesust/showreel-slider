<?php

/**
 * Composer autload
 */

require_once 'vendor/autoload.php';

/**
 * Custom functions / External files
 */
require_once 'includes/customizer.php';
require_once 'includes/custom-functions.php';

/**
 * Define global constants
 */
define( 'STYLESHEETDIR', get_stylesheet_directory() );
define( 'STYLESHEETURI', get_stylesheet_directory_uri() );


/**
 * Add support for useful stuff
 */

if ( function_exists( 'add_theme_support' ) ) {

    // Add support for document title tag
    add_theme_support( 'title-tag' );

    // Add Thumbnail Theme Support
    add_theme_support( 'post-thumbnails' );

    // Add support for Site Logo

    add_theme_support( 'custom-logo' );
    

    // Localisation Support
    load_theme_textdomain( 'echologyx', get_template_directory() . '/languages' );
}


/**
 * Hide admin bar
 */

 //add_filter( 'show_admin_bar', '__return_false' );


/**
 * Remove junk
 */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


/**
 * Remove comments feed
 *
 * @return void
 */

function echologyx_post_comments_feed_link() {
    return;
}

add_filter('post_comments_feed_link', 'echologyx_post_comments_feed_link');


/**
 * Enqueue scripts
 */

function echologyx_enqueue_scripts() {
    // wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Font+Family' );
    // wp_enqueue_style( 'icons', '//use.fontawesome.com/releases/v5.0.10/css/all.css' );
    wp_enqueue_style( 'echologyx-styles', get_stylesheet_directory_uri() . '/public/css/style.css?' . filemtime( get_stylesheet_directory() . '/public/css//style.css' ) );
    wp_enqueue_script( 'echologyx-slick', get_stylesheet_directory_uri() . '/public/js/slick.min.js?' . filemtime( get_stylesheet_directory() . '/public/js/slick.min.js' ), ['jquery'], null, true );
    wp_enqueue_script( 'echologyx-scripts', get_stylesheet_directory_uri() . '/public/js/scripts.min.js?' . filemtime( get_stylesheet_directory() . '/public/js/scripts.min.js' ), ['jquery', 'wp-util'], null, true );
    $localize_script_array = array(
        'siteURI' => STYLESHEETURI,
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    );
    wp_localize_script( 'echologyx-scripts', 'echologyx_vars', $localize_script_array );

    if( is_page( 'career') ) { 
        wp_enqueue_style( 'echologyx-career-style', get_stylesheet_directory_uri() . '/public/css/career-style.css?' . filemtime( get_stylesheet_directory() . '/public/css/career-style.css' ) );
        wp_enqueue_script( 'echologyx-career-slider', get_stylesheet_directory_uri() . '/public/js/career-slider.js?' . filemtime( get_stylesheet_directory() . '/public/js/career-slider.js' ), ['jquery', 'wp-util'], null, true );
    } 
}

add_action( 'wp_enqueue_scripts', 'echologyx_enqueue_scripts' );


/**
 * Add async and defer attributes to enqueued scripts
 *
 * @param string $tag
 * @param string $handle
 * @param string $src
 * @return void
 */

function defer_scripts( $tag, $handle, $src ) {

	// The handles of the enqueued scripts we want to defer
	$defer_scripts = [
        'SCRIPT_ID'
    ];

    // Find scripts in array and defer
    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '" defer="defer"></script>' . "\n";
    }
    
    return $tag;
} 

add_filter( 'script_loader_tag', 'defer_scripts', 10, 3 );


/**
 * Add custom scripts to head
 *
 * @return string
 */

function add_gtag_to_head() {

    // Check is staging environment
    if ( strpos( get_bloginfo( 'url' ), '.test' ) !== false ) return;

    // Google Analytics
    $tracking_code = 'UA-*********-1';
    
    ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $tracking_code; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?php echo $tracking_code; ?>');
        </script>
    <?php
}

//add_action( 'wp_head', 'add_gtag_to_head' );



/**
 * Remove unnecessary scripts
 *
 * @return void
 */

function deregister_scripts() {
    wp_deregister_script( 'wp-embed' );
}

add_action( 'wp_footer', 'deregister_scripts' );


/**
 * Remove unnecessary styles
 *
 * @return void
 */

function deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}

add_action( 'wp_print_styles', 'deregister_styles', 100 );


/**
 * Register nav menus
 *
 * @return void
 */

function echologyx_register_nav_menus() {
    register_nav_menus([
        'header' => 'Header',
        'footer' => 'Footer',
    ]);
}

add_action( 'after_setup_theme', 'echologyx_register_nav_menus', 0 );


/**
 * Nav menu args
 *
 * @param array $args
 * @return void
 */

function echologyx_nav_menu_args( $args ) {
    $args['container'] = false;
    $args['container_class'] = false;
    $args['menu_id'] = false;
    $args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';

    return $args;
}

add_filter('wp_nav_menu_args', 'echologyx_nav_menu_args');


/**
 * Button Shortcode
 *
 * @param array $atts
 * @param string $content
 * @return void
 */

function echologyx_button_shortcode( $atts, $content = null ) {
    $atts['class'] = isset($atts['class']) ? $atts['class'] : 'btn';
    return '<a class="' . $atts['class'] . '" href="' . $atts['link'] . '">' . $content . '</a>';
}

add_shortcode('button', 'echologyx_button_shortcode');


/**
 * TinyMCE
 *
 * @param array $buttons
 * @return void
 */

function echologyx_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    $buttons[] = 'hr';

    return $buttons;
}

add_filter('mce_buttons_2', 'echologyx_mce_buttons_2');


/**
 * TinyMCE styling
 *
 * @param array $settings
 * @return void
 */

function echologyx_tiny_mce_before_init( $settings ) {
    $style_formats = [
    ];

    $settings['style_formats'] = json_encode($style_formats);
    $settings['style_formats_merge'] = true;

    return $settings;
}

add_filter('tiny_mce_before_init', 'echologyx_tiny_mce_before_init');


/**
 * Get post thumbnail url
 *
 * @param string $size
 * @param boolean $post_id
 * @param boolean $icon
 * @return void
 */

function get_post_thumbnail_url( $size = 'full', $post_id = false, $icon = false ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $thumb_url_array = wp_get_attachment_image_src(
        get_post_thumbnail_id( $post_id ), $size, $icon
    );
    return $thumb_url_array[0];
}


/**
 * Add Front Page edit link to admin Pages menu
 */

function front_page_on_pages_menu() {
    global $submenu;
    if ( get_option( 'page_on_front' ) ) {
        $submenu['edit.php?post_type=page'][501] = array( 
            __( 'Front Page', 'echologyx' ), 
            'manage_options', 
            get_edit_post_link( get_option( 'page_on_front' ) )
        ); 
    }
}

add_action( 'admin_menu' , 'front_page_on_pages_menu' );


/**
 * Creates 301 redirects by request uri
 */
function redirect_by_request_uri() {
 
   if ( isset( $_SERVER['REQUEST_URI'] ) ) {
 
      // Store uri and create array of uri parts
      $request_uri = $_SERVER['REQUEST_URI'];
      $parts = explode( '/', $request_uri );
 
      // Check post slug
      if ( strpos( $parts[1], 'contact-us-2' ) !== false ) {
         $redirect = get_permalink( 1863 );
         wp_redirect( $redirect, 301 );
         exit;
      }
          
   }
}
add_action( 'template_redirect', 'redirect_by_request_uri' );

/**
 * Logger for debugging purpose
 */
function log_me($message) {
    if ( WP_DEBUG === true ) {
        if ( is_array($message) || is_object($message) ) {
            error_log( print_r($message, true) );
        } else {
            error_log( $message );
        }
    }
}


