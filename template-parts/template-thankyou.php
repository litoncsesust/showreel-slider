<?php

/*
* Template Name: Thankyou page
*/

get_header();

?>
<main class="main" role="main">
    <div class="site-thankyou-container">

        <?php while (have_posts()) : the_post();
            global $post; ?>

            <?php
            $thankyou_details = get_field('thankyou_details');
            ?>

            <div class="site-thankyou-top-sections">
                <div class="text-center">
                    <div class="thankyou-tick-icon">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/thankyou.svg'; ?>" alt="thankyou" class="tick-icon">
                    </div>
                    <h1 class="section-title section-title-light"><?php echo $thankyou_details['heading']; ?></h1>
                    <p class="thankyou-description "><?php echo $thankyou_details['description']; ?></p>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>