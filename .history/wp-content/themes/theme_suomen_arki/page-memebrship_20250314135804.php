<?php
/**
 * Template Name: Членство (Membership)
 */
get_header();
?>
    <button class="banner-title" id="openModal">
                <p>Хочешь стать членом Suomen Arki?</p>
    </button>
        <!-- Modal Structure -->
    <div id="membershipModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span> <!-- Close Button -->
            
            <div class="membership-form">
                <h2>Форма регистрации</h2>
                <?php 
                    echo do_shortcode('[contact-form-7 id="3981628" title="membership"]');
                ?>
            </div>
        </div>
    </div>
<div class="membership-page">


    <div class="membership-content">
        <?php
        // Display Page Content
        while (have_posts()) : the_post();
            the_content();
        endwhile;
        ?>
    </div>




</div>

<?php get_footer(); ?>
