<?php

/*
* Template Name: Landing page
*/

get_header();

?>
<main class="main" role="main">
    <div class="site-landing-container">

        <?php while (have_posts()) : the_post(); global $post;?>

            <?php
            $landing_hero = get_field('hero');
            $testing_tools = get_field('testing_tools');
            ?>
            <div class="site-landing-top-sections">
                <div class="site-top-hero-section">
                    <div class="hero-title-container container">
                        <div class="site-landing-abtest-icon">
                            <img src="<?php echo $landing_hero['top_logo']; ?>" alt="">
                        </div>
                        <span class="section-bottom-line"></span>
                        <h1 class="hero-title section-title-dark"><?php echo $landing_hero['hero_title']; ?></h1>
                        <p class="hero-description">
                            <?php echo $landing_hero['hero_subtitle']; ?>
                        </p>
                        <a href="<?php echo $landing_hero['cta_url']; ?>" class="contact-us-button button-stroked"><?php echo $landing_hero['cta_text']; ?></a>
                    </div>
                    <div class="testing-tools-floating-container">
                        <h1 class="testing-tools-section-title"><?php echo $testing_tools['title']; ?></h1>
                        <p class="testing-tools-description"><?php echo $testing_tools['description']; ?></p>
                        <div class="testing-tools-logos">
                            <?php 
                            if ( is_array( $testing_tools['tools_images'] ) && !empty( $testing_tools['tools_images'] ) ) :
                                foreach( $testing_tools['tools_images'] as $key => $tools_image ) :
                                ?>
                                    <div class="testing-tools-logo">
                                        <img src="<?php echo $tools_image['image']; ?>" alt="">
                                    </div>
                                <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <a href="<?php echo $testing_tools['cta_url']; ?>" class="see-dev-process-button button-stroked button-bg-light"><?php echo $testing_tools['cta_text']; ?></a>
                    </div>
                </div>
            </div>

            <?php get_template_part('template-parts/global/section', 'testimonial', ['page' => $post->post_name, 'type' => 'carousel']); ?>
            <?php get_template_part( 'template-parts/global/section', 'writetous', ['page' => $post->post_name] ); ?>
            


        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>