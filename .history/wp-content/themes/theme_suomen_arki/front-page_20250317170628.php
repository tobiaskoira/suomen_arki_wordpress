<?php
get_header();
?>
    <button class="banner-title" id="openModal">
                <p>Хочешь стать нашим волонтером?</p>
    </button>
        <!-- Modal Structure -->
    <div id="membershipModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span> <!-- Close Button -->
                       <div class="close-btn">
                <i class="icon-close"></i>
            </div> 
            <div class="membership-form">
                <h2>Форма регистрации</h2>
                <?php 
                    echo do_shortcode('[contact-form-7 id="3981628" title="membership"]');
                ?>
            </div>
        </div>
    </div>

    <div class="banner">
        <div class="banner-content">
            <div class="banner-text">
                <h2><span class="notranslate">Suomen Arki ry</span></h2>
                <p>поддержка иммигрантов через</br> образование, досуг и волонтерство</p>

            </div>

            <!-- Wrapper for bottom elements -->
            <div class="banner-bottom">
                <div class="banner-arrow">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/banner_arrow.png" alt="Arrow">
                </div>   
                <div class="button">
                    <a href="#about-us">О НАС</a>
                </div>
            </div>
        </div>
    </div>
    <!-- <?php
    echo do_shortcode('[smartslider3 slider="2"]');
    ?> -->

<div class="main-page-slider">
    <div class="main-page-slider-left">
        <?php
        echo do_shortcode('[smartslider3 slider="2"]');
        ?>
    </div>
    <div class="main-page-slider-right">
        <p>Suomen arki ry - это общественная организация Северной Карелии. 
            Цель нашей деятельности - успешная интеграция иммигрантов в финское общество, 
            а также развитие досуговой деятельности, культуры и искусства в г. Йоэнсуу и по всей Финляндии.</p>
    </div>
     
</div>
<div class="main-page-container">
    <div class="main-page-arrow-right">
        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow_right.png" alt="Arrow">
    </div>
    <div class="main-page-title">
        <h3>Актуальные мероприятия</h3>
    </div>
    <div class="main-page-actual-events">
        <?php 
        echo do_shortcode('[MEC id="125"]')
        ?>
    </div> 
    <div class="main-page-socialicons-banner" id="about-us">
        <h3>Следите за нашими мероприятиями также в соц. сетях</h3>            
        <div class="socialicons">
                <img src="<?php echo get_template_directory_uri(); ?>/icons/telegram-64.ico" alt="Arrow">
                <img src="<?php echo get_template_directory_uri(); ?>/icons/facebook-7-64.ico" alt="Arrow">
                <img src="<?php echo get_template_directory_uri(); ?>/icons/instagram-64.ico" alt="Arrow">
        </div> 
    </div>
      <div class="main-page-arrow-left">
        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow_right.png" alt="Arrow">
    </div>
</div>
    <div class="main-page-title" >
        <h3>Наша деятельность</h3>
    </div>

    <section class="projects">
   
 
        <?php
        $args = array(
            'post_type'      => 'page',
            'posts_per_page' => 6,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'page_category', // Используем нашу кастомную таксономию
                    'field'    => 'slug',
                    'terms'    => 'proekty', // Замените на ваш slug категории
                ),
            ),
        );
        
        $projects = new WP_Query($args);

        if ($projects->have_posts()) :
            $count = 0; // Counter to track even/odd items
            while ($projects->have_posts()) : $projects->the_post();
                $count++;
                $is_even = $count % 2 == 0; // Check if the post index is even

        $subtitle = get_post_meta(get_the_ID(), 'project_subtitle', true); // Fetch custom field
        ?>

                    <div class="project-container <?php echo $is_even ? 'reverse' : ''; ?>">
                    <?php if ($is_even) : ?>
                        <!-- Right side first for even items -->
                        <div class="project-container-right">
                            <div class="project-title">
                                <a href="<?php the_permalink(); ?>">
                                <h3><?php echo esc_html($subtitle); ?></h3>
                                </a>
                            </div>
                            <div class="project-description">
                                <a href="<?php the_permalink(); ?>">
                                    <p><?php the_excerpt(); ?></p>
                                </a>
                            </div>
                        </div>
                        <div class="project-container-left">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php else : ?>
                        <!-- Left side first for odd items -->
                        <div class="project-container-left">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<h3><?php the_excerpt(); ?></h3>">
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="project-container-right">
                            <div class="project-title">
                                <a href="<?php the_permalink(); ?>">
                                <h3><?php echo esc_html($subtitle); ?></h3>
                                </a>
                            </div>
                            <div class="project-description">
                                <a href="<?php the_permalink(); ?>">
                                    <p><?php the_excerpt(); ?></p>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
        <?php 
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Проектов пока нет.</p>';
        endif;
        ?>
          
    </section>

      <div class="main-page-arrow-right">
        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow_right.png" alt="Arrow">
    </div>

    <div class="main-page-title">
        <h3>Расписание и регистрация</h3>
    </div>


    <div class="main-page-events-month-calendar">
        <?php 
        echo do_shortcode('[MEC id="126"]')
        ?>
    </div>
    <div class="main-page-arrow-left">
        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow_right.png" alt="Arrow">
    </div>
    <section class = "membership">
        <div class="membership-content">
        <div class="project-title">
                        <h3>Хотите стать членом <strong>Suomen Arki ry</strong>?</h3>
                    </div>
                    <div class="project-description">
                        <p>Присоединяйтесь к нам и станьте частью нашего сообщества! ❤️</p>
                    </div>

        </div>

        <div class="membership-form">
            <h2>Форма регистрации</h2>
                <?php 
            echo do_shortcode('[contact-form-7 id="3981628" title="membership"]')
            ?>
        </div>
    </section>

<?php


get_footer();
?>
