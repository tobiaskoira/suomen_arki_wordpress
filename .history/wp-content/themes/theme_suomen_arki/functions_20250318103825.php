<?php
//menu registering 

    register_nav_menus(["primary"=>"Primary menu"]);
//adding own styles
    function suomenarkiassets_assets() {
        wp_enqueue_style("style", get_stylesheet_uri()); 
       
    }
    add_action("wp_enqueue_scripts", "suomenarkiassets_assets");

// adding own font //
    function enqueue_google_fonts() {
        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet', false);
        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"', false);
    }
    add_action('wp_enqueue_scripts', 'enqueue_google_fonts');
// adding simple line icons
    function enqueue_simple_line_icons() {
        wp_enqueue_style('simple-line-icons', get_template_directory_uri() . '/icons/simple-line-icons-master/css/simple-line-icons.css', array(), null);
    }
    add_action('wp_enqueue_scripts', 'enqueue_simple_line_icons');

//override smart slider 3 plugin styles
    function custom_enqueue_styles() {
        wp_enqueue_style("style", get_stylesheet_uri(), array(), '1.0', 'all');
    }
    add_action('wp_enqueue_scripts', 'custom_enqueue_styles');
//override modern event plugin styles
    function custom_mec_styles() {
        wp_enqueue_style("style", get_stylesheet_uri(), array(), '1.0', 'all');
    }
    add_action('wp_enqueue_scripts', 'custom_mec_styles');
//overide Gtranslate plugin styles
    function custom_gtranslate_styles() {
        wp_enqueue_style("style", get_stylesheet_uri(), array(), '1.0', 'all');
    }
    add_action('wp_enqueue_scripts', 'custom_gtranslate_styles');
//creating custom posts
function custom_post_type_projects() {
    register_post_type('project',
        array(
            'labels'      => array(
                'name'          => __('projects'),
                'singular_name' => __('project'),
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-portfolio',
            'supports'    => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'taxonomies'  => array('category'),
            'rewrite'     => array('slug' => 'projects'),
        )
    );
}
add_action('init', 'custom_post_type_projects');

// Добавление категорий для проектов (таксономии)

function create_project_taxonomy() {
    register_taxonomy(
        'project_category',
        'projects',
        array(
            'label'        => __('project-category'),
            'rewrite'      => array('slug' => 'project-category'),
            'hierarchical' => true, // Позволяет делать вложенные категории
        )
    );
}
add_action('init', 'create_project_taxonomy');

// Включаем поддержку миниатюр и добавляем свой размер

function custom_theme_setup() {
    add_theme_support('post-thumbnails'); 
    add_image_size('project-thumb', 400, 300, true); }
add_action('after_setup_theme', 'custom_theme_setup');

// Scrolling up button
function enqueue_scroll_to_top_script() {
    wp_enqueue_script("scroll-to-top", get_template_directory_uri() . "/js/script.js", array(), time, true);
}
add_action("wp_enqueue_scripts", "enqueue_scroll_to_top_script");

//Enable WooCommerce in functions.php
function mytheme_add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

//Change word add to cirt to register
function custom_woocommerce_add_to_cart_text($text) {
    return __('Записаться', 'woocommerce'); 
}
add_filter('woocommerce_product_add_to_cart_text', 'custom_woocommerce_add_to_cart_text'); 
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_woocommerce_add_to_cart_text'); 

function custom_woocommerce_related_products_text() {
    return __('Похожие мероприятия', 'woocommerce'); 
}
add_filter('woocommerce_product_related_products_heading', 'custom_woocommerce_related_products_text'); 
 
function custom_woocommerce_title_header($title) {
    if (is_shop()) { // Apply only to the shop page
        return __('Список мероприятий', 'woocommerce'); // New title
    }
    return $title;
}
add_filter('woocommerce_page_title', 'custom_woocommerce_title_header');

// only admins could pass to admin panel
function restrict_admin_access(){
    if(!current_user_can('manage_options') && !wp_doing_ajax()){
        wp_redirect(home_url());
        exit;
    }
};

// do not show admin bar for all visitors except admins
add_action('after_setup_theme', function() {
    if (!current_user_can('manage_options')) {
        show_admin_bar(false);
    }
});

// styling product single page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'custom_move_product_tabs',  );


function custom_move_product_tabs() {
    woocommerce_output_product_data_tabs();
}


//take of link from menu title
function disable_menu_link($items, $args) {
    foreach ($items as $item) {
        if ($item->title == "Наша деятельность") {
            $item->url = "#";
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'disable_menu_link', 10, 2);

//Disable Auto <p> and <br> in Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

//  remove the default <h1> and replace it with <h3>
function custom_woocommerce_shop_page_title() {
    echo '<div class="main-page-title woocommerce-products-header">';
    echo '<h3 class="woocommerce-products-header__title page-title">' . woocommerce_page_title(false) . '</h3>';
    echo '</div>';
}

// Remove default <h1> title
remove_action( 'woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10 );

// Add custom <h3> title inside div
add_action( 'woocommerce_shop_loop_header', 'custom_woocommerce_shop_page_title', 10 );


//create custom taxonomy for pages
function add_categories_to_pages() {
    register_taxonomy(
        'page_category', 
        'page', 
        array(
            'label'        => 'Категории страниц',
            'rewrite'      => array('slug' => 'page-category'),
            'hierarchical' => true,
            'show_admin_column' => true, 
        )
    );
}
add_action('init', 'add_categories_to_pages');
//add ecerpt functionality for pages
function add_excerpt_to_pages() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_excerpt_to_pages');

//custom fileds addiing

function enable_custom_fileds(){
    add_post_type_support('page', 'custom-fields');
}
add_action('init', 'enable_custom_fileds');

//delete additional information from product
add_filter( 'woocommerce_product_tabs', 'remove_additional_information_tab', 98 );
function remove_additional_information_tab( $tabs ) {
    unset( $tabs['additional_information'] ); // Убираем вкладку "Дополнительная информация"
    return $tabs;
}

?> 