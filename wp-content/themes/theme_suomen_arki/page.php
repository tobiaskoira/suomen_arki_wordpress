<?php
get_header();
?>

<main class="page-content">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>
            <article class="single-page">
                <h1><?php the_title(); ?></h1>

                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                <?php endif; ?>

                <div class="page-text">
                    <?php the_content(); ?> <!-- ✅ Allows adding content via the editor -->
                </div>
            </article>
        <?php endwhile;
    else :
        echo '<p>Страница не найдена.</p>';
    endif;
    ?>
</main>

<?php
get_footer();
?>
