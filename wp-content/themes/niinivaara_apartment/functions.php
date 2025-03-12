<?php
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    
    register_nav_menus(["primary"=>"Primary menu"]);

    function niinivaaraapartments_assets() {
        wp_enqueue_style("style", get_stylesheet_uri()); 
       
    }
    add_action("wp_enqueue_scripts", "niinivaaraapartments_assets");
    // adding own font //
    function enqueue_google_fonts() {
        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet', false);
    }
    add_action('wp_enqueue_scripts', 'enqueue_google_fonts');

    function niinivaaraapartments_widgets_init() {
        register_sidebar(array(
            'name'          => 'Sidebar',
            'id'            => 'sidebar',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        ));
    }
    add_action('widgets_init', 'niinivaaraapartments_widgets_init');

    function niinivaarapartments_enqueue_font_awesome() {
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', [], null);
    }
    add_action('wp_enqueue_scripts', 'niinivaarapartments_enqueue_font_awesome');


    function niinivaarapartments_contact_settings_page() {
        add_menu_page(
            'Our contacts',    
            'Contacts',               
            'manage_options',        
            'contact-settings',       
            'render_contact_settings_page', 
            'dashicons-id',        
            100                    
        );
    }
    add_action('admin_menu', 'niinivaarapartments_contact_settings_page');

    function niinivaaraapartments_theme_setup(){
        add_theme_support('title-tag');
    }
    add_action('after_setup_theme','niinivaaraapartments_theme_setup' );

    function render_contact_settings_page() {
   
        if (!current_user_can('manage_options')) {
            return;
        }
    
       
        if (isset($_POST['submit'])) {
            error_log('Saving contact settings...');
            error_log('Address: ' . sanitize_text_field($_POST['contact_address']));
            error_log('Phone: ' . sanitize_text_field($_POST['contact_phone']));
            error_log('Email: ' . sanitize_email($_POST['contact_email']));
        
            update_option('contact_address', sanitize_text_field($_POST['contact_address']));
            update_option('contact_phone', sanitize_text_field($_POST['contact_phone']));
            update_option('contact_email', sanitize_email($_POST['contact_email']));
            echo '<div class="updated"><p>Settings saved</p></div>';
        }
    

        $address = get_option('contact_address', '');
        $phone = get_option('contact_phone', '');
        $email = get_option('contact_email', '');
        ?>
        <div class="wrap">
            <h1>Contacts settings</h1>
            <form method="post" action="">
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="contact_address">Address</label></th>
                        <td><input type="text" id="contact_address" name="contact_address" value="<?php echo esc_attr($address); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="contact_phone">Phone</label></th>
                        <td><input type="text" id="contact_phone" name="contact_phone" value="<?php echo esc_attr($phone); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="contact_email">Email</label></th>
                        <td><input type="email" id="contact_email" name="contact_email" value="<?php echo esc_attr($email); ?>" class="regular-text"></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
    function niinivaaraapartments_custom_excerpt_more($more) {
        return '... <a href="' . get_permalink() . '">Read More</a>';
    }
    add_filter('excerpt_more', 'niinivaaraapartments_custom_excerpt_more');    


    function niinivaaraapartments_enqueue_custom_scripts() {
        wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
    }
    add_action('wp_enqueue_scripts', 'niinivaaraapartments_enqueue_custom_scripts');

/* Woocommerce*/

/* help to override my owm page.php */
function mytheme_add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');
/* removing pay now button */

add_filter('woocommerce_my_account_my_orders_actions', 'remove_pay_now_button', 10, 2);
function remove_pay_now_button($actions, $order) {
    if ($order->has_status('pending')) {
        unset($actions['pay']);
    }
    return $actions;
}
/* Awaiting Payment, custom order status  */
add_filter('wc_order_statuses', 'custom_order_statuses');
function custom_order_statuses($order_statuses) {
    $order_statuses['wc-awaiting-payment'] = 'Awaiting Payment';
    return $order_statuses;
}

/* removing some billing details */

add_filter( 'woocommerce_billing_fields', 'customize_billing_fields' );

function customize_billing_fields( $fields ) {
    // Unset fields you want to remove
    unset( $fields['billing_country'] );
    unset( $fields['billing_company'] );  // Remove company name
    unset( $fields['billing_city'] );  
    unset( $fields['billing_address_1'] );
    unset( $fields['billing_address_2'] );  // Remove address line 2
    unset( $fields['billing_state'] );  // Remove state
    unset( $fields['billing_postcode'] );  // Remove postcode/zip


    return $fields;
}

function custom_add_to_cart_multilang( $text, $product ) {
    // Check the current language
    if ( function_exists( 'pll_current_language' ) ) {
        $current_lang = pll_current_language();

        if ( $current_lang == 'en' ) { // English
            return 'Book Now';
        } elseif ( $current_lang == 'fi' ) { // Finnish
            return 'Varaa Nyt';
        } elseif ( $current_lang == 'ru' ) { // Russian
            return 'Забронировать';
        }
    }

    // Default text if no language match
    return $text;
}
add_filter( 'woocommerce_product_add_to_cart_text', 'custom_add_to_cart_multilang', 10, 2 );


?>

