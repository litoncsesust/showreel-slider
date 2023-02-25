<?php

/*
* Template Name: Career page
* Design and developed by : Ahmed Shakil
*/

get_header();

?>
<main class="main" role="main">
    <div class="site-career-container">

        <?php while (have_posts()) : the_post();
            global $post; ?>

            <?php
            $career_hero = get_field("hero");
            $career_position = get_field("position");
            $career_culture = get_field("career_culture");
            $career_culture_group = get_field("career_culture_group");
            $career_culture_group_bottom = get_field("career_culture_group_bottom");
            
            $future_job = get_field("future_job");
            $career_query = get_field("query");
            $job_args = array(
                'posts_per_page' => -1,
                'offset'           => 0,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'post_type'        => 'job',
                'post_status'      => 'publish',
                'suppress_filters' => true
            );
            $job_query = new WP_Query($job_args);

            ?>
            <div class="site-career-top-sections" style="background-image: url('<?php echo $career_hero['image']; ?>');">
                <div class="section-header">
                    <div class="career-hero-title-container">
                        <h1 class="section-title section-title-dark">
                            <?php echo $career_hero['title']; ?>
                        </h1>
                        <p class="hero-subtitle"><?php echo $career_hero['subtitle']; ?></p>
                        <a href="#career-positions-section" class="button-filled"><?php echo __('view open positions', 'echologyx'); ?></a>
                    </div>
                </div>
            </div>


            <div id="career-culture-section" class="career-culture-section container">

                <div class="graphics-container container">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/Group.png'; ?>" alt="">
                </div>
                <div class="culture-header">
                    <h1 class="section-title section-title-light"><?php echo $career_culture['title']; ?></h1>
                </div>
                <div class="culture-sub-header">
                    <p class="section-sub-title section-sub-title-light"><?php echo $career_culture['sub_title']; ?></p>
                </div>
                <div class="career-culture-group">                   
                    <div class="career-culture-group-block">
                        <?php 
                        if($career_culture_group){
                            foreach ($career_culture_group as $key => $career_culture_group_item) { ?>
                            <div class="career-culture-group-item">
                                <div class="career-culture-group-icon">
                                    <img src="<?php echo $career_culture_group_item['career_group_icon']; ?>" alt=""></div>
                                <div class="career-culture-group-description"><?php echo $career_culture_group_item['career_group_description']; ?></div>
                            </div>
                        <?php } 
                        } ?>
                    </div>
                    <?php if($career_culture_group_bottom){ ?>
                    <div class="career-culture-group-bottom-description">
                       <?php echo $career_culture_group_bottom; ?>
                    </div>
                    <?php } ?>
                    <?php if(!$career_culture['gallery']){ ?>
                    <div class="career-culture-gallery-wrapper">
                        <div class="career-culture-gallery">
                            <?php foreach ($career_culture['gallery'] as $key => $gallery_img) { ?>
                                <div class="culture-gallery-item"><img src="<?php echo $gallery_img; ?>" alt=""></div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <?php if($career_culture['gallery']){ ?>
            <div id="career_wrapper_widget_7854248655" class="career_wrapper career_wrapper_widget career_wrapper_type_module" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <header class="section-intro section-intro--padded-bg theme--white" data-section-intro="" data-module="Section intro">
                    <div class="slider-wrapper layout--row" id="benefits" data-submenu-sticky-section="">
                        <div class="showslider showslider--unfolded showslider--scaled showslider--activated" data-showslider="" data-component="showslider" style="--showslider-width:920; --showslider-slide-width:384; --showslider-slider-scroll:1504;">
                            <div class="showslider__nav" data-showslider-nav="">
                                <button class="showslider__button showslider__button--prev" aria-hidden="true" data-showslider-prev="">
                                    <span class="visually-hidden">Go to previous slide.</span>
                                    <svg class="arrow arrow-left" width="20" height="17" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.45 7.036L8.485 0 9.9 1.414 3.914 7.4H20v2H3.814l6.085 6.086L8.485 16.9 1.45 9.864l-.036.035L0 8.485l.036-.035L0 8.414 1.414 7l.036.036z" fill="currentColor" fill-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <button class="showslider__button showslider__button--next" aria-hidden="true" data-showslider-next="" disabled="">
                                    <span class="visually-hidden">Go to next slide.</span>
                                    <svg class="arrow arrow-right" width="20" height="17" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.55 9.864l-7.035 7.035-1.414-1.414L16.086 9.5H0v-2h16.186l-6.085-6.086L11.515 0l7.035 7.036.036-.036L20 8.414l-.036.036.036.035L18.586 9.9z" fill="currentColor" fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <ul class="showslider__slides" data-showslider-slider="">
                                <?php foreach ($career_culture['gallery'] as $key => $gallery_img) { ?>
                                <li class="showslider__slide showslider__slide--first" data-showslider-slide="" style="--showslider-slide-offset:0;">
                                    <figure
                                        class="image image--cover"
                                        data-image=""
                                        data-image-random-fallback=""
                                        data-component="image"
                                        style="--image-max-width:40.0rem;--image-max-height:30.0rem;--image-ratio:64.0%;">
                                        <img
                                            class="image__content"
                                            srcset="
                                                <?php echo $gallery_img; ?>?width=430&amp;height=320&amp; 430w,
                                                <?php echo $gallery_img; ?>?width=960&amp;height=720&amp; 960w
                                            "
                                            src="<?php echo $gallery_img; ?>?width=430&amp;height=320&amp"
                                            alt=""
                                            loading="lazy"
                                            data-image-content=""
                                        />
                                    </figure>
                                </li>
                                <?php } ?>                                
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
            <?php } ?>



            <div id="career-positions-section" class="career-positions-section container">

                <div class="position-header">
                    <span class="small-career">career</span>
                    <h1 class="section-title section-title-light"><?php echo $career_position['title']; ?></h1>
                    <p class="position-subtitile"><?php echo $career_position['subtitle'] ?></p>
                </div>

                <div class="all-job">
                    <?php foreach ($job_query->posts as $key => $jpost) {
                        $job_details = get_field("job_details", $jpost->ID);
                        $job_header = array_filter( $job_details['job_header'], function( $value, $key ) {
                            return $value !== '';
                        }, ARRAY_FILTER_USE_BOTH );
                    ?>
                        <div class="job">
                            <div class="job-detail">
                                <h1 class="job-title"><?php echo $jpost->post_title; ?></h1>
                                <div class="job-header">
                                    <ul>
                                        <?php foreach ($job_header as $key => $heading) { ?>
                                            <li> <span> <?php echo ucwords(str_replace('_', ' ', $key)); ?>: </span> <?php echo $heading; ?> </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="action">
                                <a href="<?php echo get_the_permalink($jpost->ID); ?>" class="button-filled"><?php echo __('Apply', 'echologyx'); ?></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div id="career-future-job-section" class="career-future-job-section container">
                <p class="future-job-title"><?php echo $future_job['title'] ?></p>
                <p class="future-job-subtitle"><?php echo $future_job['subtitle'] ?></p>
                <div class="action">
                    <a href="<?php echo $future_job['future_job_cta'] ?>" class="button-filled"><?php echo __('Apply for future roles', 'echologyx'); ?></a>
                </div>
            </div>

            <?php get_template_part('template-parts/global/section', 'have-query', ['page' => $post->post_name]); ?>
        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>