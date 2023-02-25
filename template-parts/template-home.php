<?php

/*
* Template Name: Home page
*/

get_header();

?>
<main class="main" role="main">
    <div class="site-homepage-container">

        <?php while (have_posts()) : the_post(); global $post; ?>

            <?php
            $home_hero = get_field('hero');
            ?>
            <div class="site-homepage-top-sections">
                <div class="site-top-hero-section">
                    <div class="hero-title-container container" style="background-image: url('<?php echo get_stylesheet_directory_uri() . '/public/img/favpng_technology-download.webp'; ?>');">
                        <div class="row">
                            <div class="col col--sm-12 col--md-12 col--lg-9">
                                <h1 class="hero-title"><?php echo $home_hero['hero_title']; ?></h1>
                                <p class="hero-subtitle"><?php echo $home_hero['hero_subtitle']; ?></p>
                                <a href="<?php echo $home_hero['cta_url']; ?>" class="get-quote-button button-filled"><?php echo $home_hero['cta_text']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php get_template_part( 'template-parts/global/section', 'services', ['page' => $post->post_name] ); ?>
            </div>
            <?php get_template_part( 'template-parts/global/section', 'jobcounter', ['page' => $post->post_name] ); ?>
            <?php get_template_part('template-parts/global/section', 'testimonial', ['page' => $post->post_name, 'type' => 'carousel']); ?>
            <?php get_template_part( 'template-parts/global/section', 'client', ['page' => $post->post_name] ); ?>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>