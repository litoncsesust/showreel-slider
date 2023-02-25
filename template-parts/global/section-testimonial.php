<?php
$what_client_say = get_field('what_client_say');
?>
<div id="testimonials" class="site-global-testimonial-section <?php echo $args['page']; ?>">
    <?php //if ( $args['page'] == 'home' ) : ?>
        <div class="testimonial-top-graphics container">
            <div class="text-container">
                <p class="testimonial-top-graphics-text">Don’t just take our word for it…</p>
            </div>
            <div class="graphics-container">
                <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/Group.png'; ?>" alt="">
            </div>
        </div>
    <?php //endif; ?>
    <div class="testimonial-main-container container">
        <div class="section-header">
            <h3 class="section-text-over-title"><?php echo $what_client_say['text_over_title']; ?></h3>
            <h1 class="section-title section-title-light">
                <?php echo $what_client_say['title']; ?>
            </h1>
        </div>

        <div class="section-contents">
            <?php if ( $what_client_say['show_global'] ) : 
                $testimonials_args = array(
                    'posts_per_page' => $what_client_say['number_of_testimonials'],
                    'offset'           => 0,
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => 'client_testimonial',
                    'post_status'      => 'publish',
                    'suppress_filters' => true
                );
                $testimonial_query = new WP_Query($testimonials_args);
                $testimonials = [];
                foreach ($testimonial_query->posts as $key => $tpost) {
                    $testimonials[] = get_field( "testimonial", $tpost->ID );
                }
            ?>
            <div class="testimonial-clients-logos">
                <div class="testimonial-carosel-container">
                    <?php foreach ( $testimonials as $key => $testimonial ) :
                    ?>
                        <div class="testimonial-carosel-item <?php echo $key < 1 ? 'active' : ''; ?>" data-testimonial_index="<?php echo $key; ?>">
                            <img src="<?php echo $testimonial['client_logo']; ?>" alt="">
                            <div class="arrow-down"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <span class="testimonail-quote-icon outside-icon"><img src="<?php echo get_stylesheet_directory_uri() . '/public/img/apos.svg'; ?>" alt=""></span>
            <div class="testimonial-clients-quotes <?php echo $args['page']; ?> <?php echo $args['type']; ?>">
                <?php foreach ( $testimonials as $key => $testimonial) : ?>
                    <div class="testimonial-qoute-item <?php echo $key < 1 ? 'active' : ''; ?> <?php echo $args['page']; ?>">
                        <span class="testimonail-quote-icon"><img src="<?php echo get_stylesheet_directory_uri() . '/public/img/apos.svg'; ?>" alt=""></span>
                        <div class="testimonial-qoute-wrap">
                            <div class="clients-quote">
                                <p><?php echo $testimonial['client_quotes']; ?></p>
                            </div>
                            <div class="testimonial-footer">
                                <div class="clients-details">
                                    <div class="client-brand-logo">
                                        <img src="<?php echo $testimonial['client_logo']; ?>" alt="">
                                    </div>
                                    <div class="clients-information">
                                        <p class="clients-name"><?php echo $testimonial['client_name']; ?></p>
                                        <p class="clients-designation"><?php echo $testimonial['client_designation']; ?></p>
                                    </div>
                                </div>
                                <div class="all-testimonals-button-container">
                                    <!-- <a href="<?php echo $what_client_say['cta_url']; ?>" class="all-testimonals-button button-stroked button-bg-light"><?php echo $what_client_say['cta_text']; ?></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php else : ?>
                <div class="testimonial-clients-logos">
                <div class="testimonial-carosel-container">
                    <?php foreach ($what_client_say['testimonials'] as $key => $testimonial) : ?>
                        <div class="testimonial-carosel-item <?php echo $key < 1 ? 'active' : ''; ?>">
                            <img src="<?php echo $testimonial['client_logo']; ?>" alt="">
                            <div class="arrow-down"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="testimonial-clients-quotes">
                <?php foreach ($what_client_say['testimonials'] as $key => $testimonial) : ?>
                    <div class="testimonial-qoute-item <?php echo $key < 1 ? 'active' : ''; ?>">
                        <span class="testimonail-quote-icon"><img src="<?php echo get_stylesheet_directory_uri() . '/public/img/apos.svg'; ?>" alt=""></span>
                        <div class="clients-quote">
                            <p><?php echo $testimonial['quote']; ?></p>
                        </div>
                        <div class="testimonial-footer">
                            <div class="clients-details">
                                <div class="client-brand-logo">
                                    <img src="<?php echo $testimonial['client_logo']; ?>" alt="">
                                </div>
                                <div class="clients-information">
                                    <p class="clients-name"><?php echo $testimonial['client_name']; ?></p>
                                    <p class="clients-designation"><?php echo $testimonial['designation']; ?></p>
                                </div>
                            </div>
                            <div class="all-testimonals-button-container">
                                <!-- <a href="<?php echo $what_client_say['cta_url']; ?>" class="all-testimonals-button button-stroked button-bg-light"><?php echo $what_client_say['cta_text']; ?></a> -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>