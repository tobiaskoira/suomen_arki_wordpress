<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">



<meta charset="<?php bloginfo('charset');?>">

<?php wp_head();?> <!-- adding hooks-->
</head>

<body <?php body_class();?>>
<header id="main-header">
    <div class="commerce-menu">
    <!-- User Account -->
    <div class="header-user">
            <?php if (is_user_logged_in()) : ?>
                <div class="user-dropdown">
                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="user-icon">


                        <i class="icon-user"></i> <span>Мой аккаунт</span>
                    </a>
                    <ul class="user-menu">
                        <li><a href="<?php echo wc_get_endpoint_url('orders'); ?>">📦 Мои заказы</a></li>
                        <li><a href="<?php echo wc_get_endpoint_url('edit-address'); ?>">🏠 Адрес</a></li>
                        <li><a href="<?php echo wc_get_endpoint_url('edit-account'); ?>">⚙️ Настройки</a></li>
                        <li><a href="<?php echo wp_logout_url(home_url()); ?>">🚪 Выйти</a></li>
                    </ul>
                </div>
            <?php else : ?>
                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="user-icon">
                    <i class="icon-user"></i> <span>Войти</span>
                </a>

            <?php endif; ?>
        </div>


                <!-- Cart Icon -->
                <div class="header-cart">
                    <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="View your shopping cart">
                        <i class="icon-basket"></i> 
                        <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </a>
                </div>

    </div>

    <div class="header-content">
        <!-- Logo (Left) -->
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/Logo.png" alt="<?php bloginfo('name'); ?>">
            </a>
        </div>

     
        <nav id="top-navi">            
            <div class="close-btn">
                <i class="icon-close"></i>
            </div>
            <!-- Language Switcher -->
            <div id="language-switcher">
                <?php echo do_shortcode('[gtranslate]'); ?>
            </div>
            <?php
            $args = ['theme_location' => 'primary'];
            wp_nav_menu($args);
            ?>  
             <!-- Header mobile -->
            <div class="commerce-menu-mobile">
            <!-- User Account -->
            <div class="header-user">
                    <?php if (is_user_logged_in()) : ?>
                        <div class="user-dropdown">
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="user-icon">


                                <i class="icon-user"></i> <span>Мой аккаунт</span>
                            </a>
                            <ul class="user-menu">
                                <li><a href="<?php echo wc_get_endpoint_url('orders'); ?>">📦 Мои заказы</a></li>
                                <li><a href="<?php echo wc_get_endpoint_url('edit-address'); ?>">🏠 Адрес</a></li>
                                <li><a href="<?php echo wc_get_endpoint_url('edit-account'); ?>">⚙️ Настройки</a></li>
                                <li><a href="<?php echo wp_logout_url(home_url()); ?>">🚪 Выйти</a></li>
                            </ul>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="user-icon">
                            <i class="icon-user"></i> <span>Войти</span>
                        </a>

                    <?php endif; ?>
                </div>


      

            </div>
        </nav>

            <!-- Hamburger Menu (Mobile Only) -->
        <div id="hamburger-menu">
                <i class="icon-menu"></i>
        </div>
        <!-- Right Section (User Icon + Cart + Language Switcher) -->
        <div class="header-right">


            <!-- Language Switcher -->
            <div id="language-switcher">
                <?php echo do_shortcode('[gtranslate]'); ?>
            </div>


        </div>
    </div>
</header>

