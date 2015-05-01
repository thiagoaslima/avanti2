<?php

function add_image_insert_override($sizes){
    // unset( $sizes['thumbnail']);
    // unset( $sizes['medium']);
    unset( $sizes['large']);
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'add_image_insert_override' );


function avanti_setup() {
    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support('post-thumbnails');

    add_image_size('avanti-large', 1200);
    add_image_size('avanti-mezzo', 650);


    register_nav_menus(array(
        'primary' => __('Primary Menu', 'avanti')
    ));
}

add_action('after_setup_theme', 'avanti_setup');

/**
 * Rewrite rules
 * 
 * @since avanti 1.0
 */
// QUERY_VARS
add_filter('query_vars', 'add_custom_query_vars');

function add_custom_query_vars($vars) {
    $vars[] = 'linha';
    $vars[] = 'colecao';
    $vars[] = 'tapete';
    return $vars;
}

// REWRITE RULES AND PERMALINKS
require_once('includes/rewrite-rules.php');
require_once('includes/customize-permalink.php');


// https://docs.dev4press.com/tutorial/wordpress/debug-wordpress-rewrite-rules-matching/
function dev4press_debug_page_request() {
    global $wp, $template;
    define("D4P_EOL", "\r\n");

    echo '<pre> Request: ';
    echo empty($wp->request) ? "None" : esc_html($wp->request);
    echo '' . D4P_EOL;
    echo ' Matched Rewrite Rule: ';
    echo empty($wp->matched_rule) ? "None" : esc_html($wp->matched_rule);
    echo ' ' . D4P_EOL;
    echo ' Matched Rewrite Query: ';
    echo empty($wp->matched_query) ? "None" : esc_html($wp->matched_query);
    echo ' ' . D4P_EOL;
    echo ' Loaded Template: ';
    echo basename($template);
    echo ' ' . D4P_EOL . '</pre>';
}

/**
 * Enqueue scripts and styles.
 *
 * @since avanti 1.0
 */
function avanti_scripts() {

    wp_enqueue_style('purecss', get_template_directory_uri() . '/css/pure.css');
    wp_enqueue_style('offset-grid', get_template_directory_uri() . '/css/offset-grid.css');
    wp_enqueue_style('styles', get_template_directory_uri() . '/css/styles.css');
    wp_enqueue_style('header', get_template_directory_uri() . '/css/header.css');
    wp_enqueue_style('content', get_template_directory_uri() . '/css/content.css');
    wp_enqueue_style('blog', get_template_directory_uri() . '/css/blog.css');
    wp_enqueue_style('typography', get_template_directory_uri() . '/css/typography.css');
    wp_enqueue_style('medida-certa', get_template_directory_uri() . '/css/medida-certa.css');
    wp_enqueue_style('carousel', get_template_directory_uri() . '/css/carousel.css');    
    
// ANGULAR
    wp_register_script('angular', get_template_directory_uri() . '/js/libs/angular.min.js', array(), '', true);
    wp_register_script('angular-route', get_template_directory_uri() . '/js/libs/angular-route.min.js', array('angular'), '', true);
    wp_register_script('angular-loader', get_template_directory_uri() . '/js/libs/angular-loader.min.js', array('angular'), '', true);
    wp_register_script('angular-animate', get_template_directory_uri() . '/js/libs/angular-animate.min.js', array('angular'), '', true);
    wp_register_script('angular-messages', get_template_directory_uri() . '/js/libs/angular-messages.min.js', array('angular'), '', true);
    wp_register_script('angular-sanitize', get_template_directory_uri() . '/js/libs/angular-sanitize.min.js', array('angular'), '', true);
    wp_register_script('angular-locale_pt-br', get_template_directory_uri() . '/js/libs/angular-locale_pt-br.js', array('angular'), '', true);

// BOOTSTRAP
    wp_register_script('ui-bootstrap', get_template_directory_uri() . '/js/libs/ui-bootstrap-carousel-e-collapse-tpls-0.12.1.min.js', array('angular'), '', true);

// CORE
    wp_register_script('app', get_template_directory_uri() . '/js/scripts/app.js', array('angular'), '', true);
    wp_register_script('core', get_template_directory_uri() . '/js/scripts/core/core.module.js', array('angular'), '', true);
    wp_register_script('routes', get_template_directory_uri() . '/js/scripts/core/routes.js', array('angular'), '', true);
    wp_register_script('routesInfo', get_template_directory_uri() . '/js/scripts/core/routesInfo.js', array('angular'), '', true);
    wp_register_script('routeInterceptor', get_template_directory_uri() . '/js/scripts/core/viewRouteInterceptor.js', array('angular'), '', true);
    wp_register_script('wp-json', get_template_directory_uri() . '/js/scripts/core/wp-json.js', array('angular'), '', true);

// MODELS
    wp_register_script('cpt_models', get_template_directory_uri() . '/js/scripts/avanti_db.js', array('angular'), '', true);

// CONTROLLERS
    wp_register_script('controllers', get_template_directory_uri() . '/js/scripts/controllers/controllers.module.js', array('angular'), '', true);
    wp_register_script('headerCtrl', get_template_directory_uri() . '/js/scripts/controllers/headerController.js', array('angular'), '', true);
    wp_register_script('linhaCtrl', get_template_directory_uri() . '/js/scripts/controllers/linhaController.js', array('angular'), '', true);
    wp_register_script('colecaoCtrl', get_template_directory_uri() . '/js/scripts/controllers/colecaoController.js', array('angular'), '', true);
    wp_register_script('tapeteCtrl', get_template_directory_uri() . '/js/scripts/controllers/tapeteController.js', array('angular'), '', true);
    wp_register_script('blogCtrl', get_template_directory_uri() . '/js/scripts/controllers/blogController.js', array('angular'), '', true);
    wp_register_script('sobreCtrl', get_template_directory_uri() . '/js/scripts/controllers/sobreController.js', array('angular'), '', true);
    wp_register_script('contatoCtrl', get_template_directory_uri() . '/js/scripts/controllers/contatoController.js', array('angular'), '', true);
    wp_register_script('medidaCtrl', get_template_directory_uri() . '/js/scripts/controllers/medidaController.js', array('angular'), '', true);
    wp_register_script('capaCtrl', get_template_directory_uri() . '/js/scripts/controllers/capaController.js', array('angular'), '', true);

// DIRECTIVES
    wp_register_script('directives', get_template_directory_uri() . '/js/scripts/directives/directives.module.js', array('angular'), '', true);
    wp_register_script('scroll', get_template_directory_uri() . '/js/scripts/directives/data-scroll.js', array('angular'), '', true);
    wp_register_script('carousel', get_template_directory_uri() . '/js/scripts/directives/galeria-carousel.js', array('angular'), '', true);
    wp_register_script('slider', get_template_directory_uri() . '/js/scripts/directives/galeria-lemon.js', array('angular'), '', true);
    wp_register_script('galleryCarousel', get_template_directory_uri() . '/js/scripts/directives/galleryCarousel.js', array('angular'), '', true);

// FILTERS
    wp_register_script('filters', get_template_directory_uri() . '/js/scripts/filters/filters.module.js', array('angular'), '', true);
    wp_register_script('arrayToMap', get_template_directory_uri() . '/js/scripts/filters/arrayToMap.js', array('angular'), '', true);
    wp_register_script('mapToArray', get_template_directory_uri() . '/js/scripts/filters/mapToArray.js', array('angular'), '', true);

// SERVICES
    wp_register_script('services', get_template_directory_uri() . '/js/scripts/services/services.module.js', array('angular'), '', true);
    wp_register_script('DOMutils', get_template_directory_uri() . '/js/scripts/services/DOMutils.js', array('angular'), '', true);


    wp_enqueue_script('jquery');
    wp_enqueue_script('owl.carousel');
    wp_enqueue_script('lemon');

// ANGULAR
    wp_enqueue_script('angular');
    wp_enqueue_script('angular-route');
//    wp_enqueue_script('angular-messages');
    wp_enqueue_script('angular-sanitize');
    wp_enqueue_script('angular-locale_pt-br');

    
// BOOTSTRAP
    wp_enqueue_script('ui-bootstrap');

// CORE
    wp_enqueue_script('app');
    wp_enqueue_script('core');
    wp_enqueue_script('routes');
    wp_enqueue_script('routeInterceptor');
    wp_enqueue_script('wp-json');

// MODELS
    wp_enqueue_script('cpt_models');

// CONTROLLERS
    wp_enqueue_script('controllers');
    wp_enqueue_script('headerCtrl');
    wp_enqueue_script('linhaCtrl');
    wp_enqueue_script('colecaoCtrl');
    wp_enqueue_script('tapeteCtrl');
    wp_enqueue_script('blogCtrl');
    wp_enqueue_script('sobreCtrl');
    wp_enqueue_script('contatoCtrl');
    wp_enqueue_script('medidaCtrl');
    wp_enqueue_script('capaCtrl');

// DIRECTIVES
    wp_enqueue_script('directives');
    wp_enqueue_script('scroll');
    wp_enqueue_script('carousel');
    wp_enqueue_script('slider');
    wp_enqueue_script('galleryCarousel');

// FILTERS
    wp_enqueue_script('filters');
    wp_enqueue_script('arrayToMap');
    wp_enqueue_script('mapToArray');

// SERVICES
    wp_enqueue_script('services');
    wp_enqueue_script('DOMutils');
}

add_action('init', 'avanti_scripts');

// hide admin bar
add_filter('show_admin_bar', '__return_false');


// edit wp_menu
$linhas = [];
add_filter( 'wp_setup_nav_menu_item', 'my_item_setup' );
function my_item_setup($item) {

    global $linhas;

    switch( $item->object ) : 

        case 'linha': 
            if ( strpos($item->title, 'Linha') !== 0 ) :
                $item->title = 'Linha ' . $item->title;
            endif;
            
            $linhas[$item->db_id] = $item->url;
            break;

        case 'colecao':
            $home = get_home_url();
            $parent_id = $item->menu_item_parent;

            if ( !isset( $linhas[$parent_id] ) ) :
                $parent = get_field('linha_obj', $item->object_id);
                $linhas[$parent_id] = home_url( user_trailingslashit( $parent->post_name ) );;
            endif;

            $item->url = $linhas[$parent_id] . str_replace($home . '/', '', $item->url);
            break;

    endswitch;

    return $item;
}


// html5 search form
// add_theme_support('html5', array('search-form'));

// utility
function get_featured_image_url($id) {
    return wp_get_attachment_url( get_post_thumbnail_id($id) );
}


// includes of functions used on the pages
require_once('includes/gallery.php');
require_once('includes/mosaic.php');