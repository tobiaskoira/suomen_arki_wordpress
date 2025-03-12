<footer id="site-footer">
    <div class="site-footer-content">
<!-- logo to the left -->
            <div class="logo">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/Logo.png
                    " alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
            <div class="site-footer-text">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
            <p><i class="fa-solid fa-envelope"></i> <a href="mailto:ohjaaja@suomenarki.com">ohjaaja@suomenarki.com</a></p>


            </div>
            <div class="socialicons">
                <img src="<?php echo get_template_directory_uri(); ?>/icons/Telegram.png" alt="Arrow">
                <img src="<?php echo get_template_directory_uri(); ?>/icons/Instagram.png" alt="Arrow">
                <img src="<?php echo get_template_directory_uri(); ?>/icons/Facebook.png" alt="Arrow">
            </div> 
  
   
    </div>

  <div class="scroll-up-button"> <a href="#" ><i class="icon-arrow-up"></i></a></div>

    <div class="site-footer-rights">&copy; Suomen Arki ry. Все права защищены.</div>
</footer>

<?php wp_footer(); ?> <!-- adding hooks-->
</body>
</html>