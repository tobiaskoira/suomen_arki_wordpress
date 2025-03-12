<?php
get_header();?>


    <main>
    
        <?php
        echo do_shortcode('[smartslider3 slider="2"]');
        ?> 
       
        <?php 
       
        if(have_posts()):
            while (have_posts()) :
                the_post();
                the_title('<h1>', '</h1>');
                the_content();
            endwhile;
        else :
          echo '<p>No content found</p>';
        endif;
        ?>

    </main>
    
    <div id="content">
        
    </div> <!-- content-->


<?php
get_footer();
?>