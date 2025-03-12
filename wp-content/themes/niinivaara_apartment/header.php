<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta charset="<?php bloginfo('charset');?>">
<?php wp_head();?> <!-- adding hooks-->
</head>

<body <?php body_class();?>>

<div id="site-container">
    <header id="site-header">
        <div class="header-content">
            <!-- Логотип слева -->
            <div class="logo">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg
                    " alt="<?php bloginfo('name'); ?>">
                </a>
            </div>

            <!-- Меню по центру -->
            <nav id="top-navi">
                <?php
                 $args = ['theme_location' => 'primary'];
                 wp_nav_menu($args);
                ?>
            </nav>

            <!-- Иконка смены языка справа -->
<div class="language-switcher">
    <?php
    if (function_exists('pll_the_languages')) {
        $languages = pll_the_languages(array('raw' => true)); // Get the array of languages

        if ($languages) {
            echo '<div class="current-language">';
            foreach ($languages as $lang_code => $lang) {
                if ($lang['current_lang']) { // Show the current language
                    echo '<img src="' . esc_url(get_template_directory_uri() . '/icons/' . $lang_code . '.png') . '" alt="' . esc_attr($lang['name']) . '">';
                    break;
                }
            }
            echo '</div>';
            
            echo '<ul class="language-menu">';
            foreach ($languages as $lang_code => $lang) {
                echo '<li>';
                echo '<a href="' . esc_url($lang['url']) . '">';
                echo '<img src="' . esc_url(get_template_directory_uri() . '/icons/' . $lang_code . '.png') . '" alt="' . esc_attr($lang['name']) . '">';
                echo '</a>';
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    ?>
</div>
<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>

        </div>
    </header>

