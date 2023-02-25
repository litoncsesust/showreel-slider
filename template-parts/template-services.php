<?php

/*
* Template Name: Services page
*/

get_header();

?>
<main class="main" role="main">
    <div class="site-servicespage-container">

        <?php while (have_posts()) : the_post();
            global $post; ?>

            <?php
            $services_hero = get_field('services_hero');
            $what_we_do = get_field('what_we_do');
            ?>
            <div class="site-servicespage-top-sections" style="background-image: url('<?php echo $services_hero['background_image']; ?>');">
                <div class="site-top-hero-section">
                    <div class="hero-title-container container">
                        <div class="row">
                            <div class="col col--sm-12 col--md-12 col--lg-12">
                                <h1 class="hero-title"><?php echo $services_hero['title']; ?></h1>
                                <p class="hero-subtitle"><?php echo $services_hero['subtitle']; ?></p>
                                <a href="<?php echo $services_hero['cta_url']; ?>" class="get-quote-button button-filled"><?php echo $services_hero['cta_text']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="site-top-service-section">
                <div class="section-container container">
                    <div class="section-header">
                        <h3 class="section-text-over-title"><?php echo $what_we_do['text_over_title']; ?></h3>
                        <h1 class="section-title section-title-light">
                            <?php echo $what_we_do['title']; ?>
                        </h1>
                        <p class="section-subtitle-dark"><?php echo $what_we_do['paragraph']; ?></p>
                        <span class="section-bottom-line"></span>
                    </div>

                    <div class="section-contents">
                        <div class="services-row">
                            <?php foreach ($what_we_do['services'] as $key => $service) : ?>
                                <div class="service-row-item row-orient-<?php echo $service['text_position']; ?>">
                                    <div class="row-icon">
                                        <img src="<?php echo $service['icon']; ?>" alt="">
                                    </div>
                                    <div class="row-details">
                                        <h2 class="service-item-title"><a href="<?php echo $service['details_link']; ?>" class="<?php echo $service['details_link'] ?: 'link-prevent-default'; ?>"><?php echo $service['title']; ?></a></h2>
                                        <p class="service-item-paragraph">
                                            <?php echo $service['paragraph']; ?>
                                            <?php if ( $service['details_link'] ) : ?>
                                                <a class="services-read-more" href="<?php echo $service['details_link']; ?>"><?php echo __('Read more', 'echologyx'); ?></a>
                                            <?php endif; ?>
                                        </p>
                                        <?php if ( $service['tools_title'] ) :?>
                                            <p class="service-tools-title"><?php echo $service['tools_title']; ?></p>
                                            <img class="service-tools-image" src="<?php echo $service['tools_image']; ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php get_template_part( 'template-parts/global/section', 'have-query', ['page' => $post->post_name] ); ?>
        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>