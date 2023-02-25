<?php

/*
* Template Name: Service details page
*/

get_header();
?>
<main class="main" role="main">
    <div class="site-servicedetails-container">

        <?php while (have_posts()) : the_post(); global $post; ?>

            <?php
            $service_details_hero = get_field('hero');
            ?>
            <div class="site-servicedetails-top-sections">
                <div class="site-top-hero-section" style="background-image: url(<?php //echo $service_details_hero['hero_graphics']; ?>);">
                    <div class="hero-title-container container">
                        <div class="row">
                            <div class="col col--sm-12 col--md-12 col--lg-6 col-hero-texts">
                                <div class="hero-text-wrap">
                                    <h1 class="hero-title"><?php echo $service_details_hero['hero_title']; ?></h1>
                                    <p class="hero-subtitle"><?php echo $service_details_hero['hero_subtitle']; ?></p>
                                </div>
                            </div>
                            <div class="col col--sm-12 col--md-12 col--lg-6 col-hero-graphics">
                                <div class="service-details-hero-graphics">
                                    <img src="<?php echo $service_details_hero['hero_graphics']; ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php get_template_part('template-parts/global/section', 'services-tools', ['page' => $post->post_name]); ?>
            <?php get_template_part('template-parts/global/section', 'services-details', ['page' => $post->post_name]); ?>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>