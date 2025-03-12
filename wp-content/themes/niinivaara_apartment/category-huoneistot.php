<?php
get_header(); 
$current_category = get_queried_object();
if ($current_category->slug === 'huoneistot' || $current_category->slug === 'huoneistot-en' || $current_category->slug === 'huoneistot-ru'){

?>

<main>
    <?php
    // Display the Smart Slider shortcode
    echo do_shortcode('[smartslider3 slider="2"]');
    ?>
</main>

<div id="content">
    <section class="about">        
        <h2><?php echo esc_html(get_queried_object()->name); ?></h2>
        <p><?php echo esc_html(get_queried_object()->description); ?></p>

        <div id="apartments-box">
            <?php 
            // Start the WordPress Loop
            if (have_posts()) :
                while (have_posts()) : the_post();
            ?>
                <section class="apartment">
                    <h3>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <div class="excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </section>
            <?php 
                endwhile;
            else :
            ?>
                <p>No apartments available under this category.</p>
            <?php 
            endif;
            ?>
        </div>
    </section>

    <?php get_sidebar(); ?>
</div> <!-- content -->

<?php

} else {
    // Fallback for other categories if needed
    echo '<p>This category is not supported by this template.</p>';
}
get_footer();
?>
