<?php
/*=================================================
 * Declare Global Variables
 *=================================================*/
define('ZENDVN_THEME_DIR', get_template_directory());
define('ZENDVN_THEME_URL', get_template_directory_uri());

define('ZENDVN_THEME_INC_DIR', ZENDVN_THEME_DIR . '/inc');
define('ZENDVN_THEME_WIDGET_DIR', ZENDVN_THEME_INC_DIR . '/widgets');

define('ZENDVN_THEME_CSS_URL', ZENDVN_THEME_URL . '/css');
define('ZENDVN_THEME_JS_URL', ZENDVN_THEME_URL . '/js');
define('ZENDVN_THEME_IMAGES_URL', ZENDVN_THEME_URL . '/images');
define('ZENDVN_THEME_FILES_URL', ZENDVN_THEME_URL . '/files');

/*=================================================
 * Init
 *=================================================*/

if(!class_exists('ZendvnHtml') && is_admin()) {
    require_once ZENDVN_THEME_INC_DIR . '/html.php';
    new ZendvnHtml();
}

require_once ZENDVN_THEME_WIDGET_DIR . '/main.php';
new Zendvn_Theme_Widget_Main();

/*=================================================
 * Declare Widget of Theme
 *=================================================*/
add_action('widgets_init', 'zend_theme_widget_init');
function zend_theme_widget_init() {
    register_sidebar(array(
    	'name'          => __( 'Primary Widget Area', 'zendvn' ),
    	'id'            => 'primary-widget-area',
    	'description'   => __( 'Add Widget To The Right of Website', 'zendvn' ),
        'class'         => '',
    	'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s clr">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<span class="widget-title">',
    	'after_title'   => '</span>' 
    ));
}

/*=================================================
 * 1. include css files into themes
 *=================================================*/
add_action('wp_enqueue_scripts', 'zendvn_theme_register_style');

function zendvn_theme_register_style() {
    global $wp_styles;
    $cssUrl     =   get_template_directory_uri() . '/css';
    
    wp_register_style('zendvn_theme_symple_shortcodes_styles', $cssUrl . '/symple_shortcodes_styles.css', array(), '1.0');
    wp_enqueue_style('zendvn_theme_symple_shortcodes_styles');
    
    wp_register_style('zendvn_theme_style', $cssUrl . '/style.css', array(), '1.0');
    wp_enqueue_style('zendvn_theme_style');
    
    wp_register_style('zendvn_theme_responsive', $cssUrl . '/responsive.css', array(), '1.0');
    wp_enqueue_style('zendvn_theme_responsive');
    
    wp_register_style('zendvn_theme_site', $cssUrl . '/site.css', array(), '1.0');
    wp_enqueue_style('zendvn_theme_site');
    
    wp_register_style('zendvn_theme_ie8', $cssUrl . '/ie8.css', array(), '1.0');
    $wp_styles->add_data('zendvn_theme_ie8', 'conditional', 'IE 8');
    wp_enqueue_style('zendvn_theme_ie8');
    
    wp_register_style('zendvn_theme_customizer', $cssUrl . '/customizer.css', array(), '1.0');
    wp_enqueue_style('zendvn_theme_customizer');
}
/*=================================================
 * 2. include js files into themes
 *=================================================*/
add_action('wp_enqueue_scripts', 'zendvn_theme_register_js');
function zendvn_theme_register_js() {
    $jsUrl     =   get_template_directory_uri() . '/js';
    wp_register_script('zendvn_theme_jquery_form_min', $jsUrl . '/jquery.form.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('zendvn_theme_jquery_form_min');
    
    wp_register_script('zendvn_theme_scripts', $jsUrl . '/scripts.js', array('jquery'), '1.0', true);
    wp_enqueue_script('zendvn_theme_scripts');
    
    wp_register_script('zendvn_theme_plugins', $jsUrl . '/plugins.js', array('jquery'), '1.0', true);
    wp_enqueue_script('zendvn_theme_plugins');
    
    wp_register_script('zendvn_theme_global', $jsUrl . '/global.js', array('jquery'), '1.0', true);
    wp_enqueue_script('zendvn_theme_global');
}

function zendvn_theme_script_code() {
    echo '<script type=\'text/javascript\'>
        		var wpexLocalize = {
        			"mobileMenuOpen" : "Browse Categories",
        			"mobileMenuClosed" : "Close navigation",
        			"homeSlideshow" : "false",
        			"homeSlideshowSpeed" : "7000",
        			"UsernamePlaceholder" : "Username",
        			"PasswordPlaceholder" : "Password",
        			"enableFitvids" : "true"
        		};
        	</script>';
}
add_action('wp_footer', 'zendvn_theme_script_code');