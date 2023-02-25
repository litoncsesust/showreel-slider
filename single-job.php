<?php get_header(); ?>

<main class="main" role="main">
    <div class="container echologyx-blog-post">
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $job_details = get_field("job_details");
                $job_header = array_filter($job_details['job_header'], function ($value, $key) {
                    return $value !== '';
                }, ARRAY_FILTER_USE_BOTH);
                ?>
                <div class="col col--sm-12 col--md-12 col--lg-7">
                    <article <?php post_class('echologyx-blog-post-article'); ?>>

                        <header class="post__header" role="heading">
                            <h1 class="hero-title job-title"><?php echo strtoupper(get_the_title()); ?></h1>
                            <div class="blog-post-banner">

                            </div>
                        </header>

                        <?php the_content(); ?>

                        <div class="job-description">
                            <div class="job-header">
                                <ul style="list-style-image: url('<?php echo STYLESHEETURI . '/public/img/ci_check-bold.svg'; ?>')">
                                    <?php foreach ($job_header as $key => $heading) { ?>
                                        <li><span class="heading"><span> <?php echo ucwords(str_replace('_', ' ', $key)); ?>: </span> <?php echo $heading; ?></span></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php foreach ($job_details as $key => $job_detail) {
                                if ('job_header' == $key) continue;
                                if (empty($job_detail)) continue;
                            ?>
                                <div class="job-details-item">
                                    <h3><?php echo ucwords(str_replace('_', ' ', $key)); ?></h3>
                                    <div class="job-details-item-content">
                                        <?php echo $job_detail; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <footer class="post__footer">
                            <div id="career-future-job-section" class="career-future-job-section">
                                <p class="future-job-title"><?php echo __('Not the role for you?', 'echologyx') ?></p>
                                <p class="future-job-subtitle"><?php echo __('Let’s see if there’s something else that might suit you', 'echologyx') ?></p>
                                <div class="action">
                                    <a href="/career/#career-positions-section" class="button-filled"><?php echo __('View open positions', 'echologyx'); ?></a>
                                </div>
                            </div>
                        </footer>

                    </article>
                </div>
            <?php endwhile; ?>
            <div class="col col--sm-12 col--md-12 col--lg-5 side-sticky-section">
                <div id="apply-job-modal-container" class="recent-blogs-sticky apply-job-modal-container">
                    <?php echo do_shortcode('[applicant_form job_id="' . get_the_ID() . '" job_title="' . get_the_title() . '"]'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php //get_template_part('template-parts/global/section', 'testimonial-single', ['page' => 'single-blog']); 
    ?>
</main>

<?php get_footer(); ?>