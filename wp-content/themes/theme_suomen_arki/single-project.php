<?php get_header(); ?>
<main>
    <article class="single-project">
        <h1><?php the_title(); ?></h1>
        
        <?php if (has_post_thumbnail()) : ?>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>
        <div><?php the_content(); ?></div>
    </article>
</main>
<?php get_footer(); ?>
