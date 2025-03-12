<?php
get_header();?>


    <main>
        <?php
        echo do_shortcode('[smartslider3 slider="2"]'); 
        ?>
        
        

    </main>
    
    <div id="content">
        <section class="about">
            <?php 

            $default_about_page = get_posts(
                array(
                    'post_type'              => 'page',
                    'name'                   => 'about-us',
                    'post_status'            => 'all',
                    'numberposts'            => 1,
                    'update_post_term_cache' => false,
                    'update_post_meta_cache' => false,           
                    'orderby'                => 'post_date ID',
                    'order'                  => 'ASC',
                )
            );
 
            if ( ! empty( $default_about_page ) ) {
                $page_got_by_title = $default_about_page[0];
            } else {
                $page_got_by_title = null;
            }
            $default_page_id = $page_got_by_title->ID;
            $translated_page_id = function_exists('pll_get_post') ? pll_get_post($default_page_id) : $default_page_id;
            
            $about_page = new WP_Query([
                'post_type' => 'page',
                'page_id' => $translated_page_id,
                'posts_per_page' => 1,
            ]);

            if ($about_page->have_posts()) {
                while ($about_page->have_posts()) {
                    $about_page->the_post();
                
                    echo '<h1>' . get_the_title() . '</h1>';
                    echo '<div>' . get_the_content() . '</div>';
                }
                wp_reset_postdata();
            } else {
                echo 'Page not found.';
            }

            ?>

        </section>
        <?php get_sidebar();?>
    </div> <!-- content-->


<?php
get_footer();
?>