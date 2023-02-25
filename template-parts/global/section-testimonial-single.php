<?php
$what_client_say = get_field('what_client_say', 'option');
$testimonial = get_field("testimonial", $what_client_say['testimonial']);
?>
<div class="site-global-testimonial-section <?php echo $args['page']; ?>">
    <?php //if ( $args['page'] == 'home' ) : 
    ?>
    <div class="testimonial-top-graphics container">
        <div class="text-container">
            <p class="testimonial-top-graphics-text">Don’t just take our word for it…</p>
        </div>
        <div class="graphics-container">
            <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/Group.png'; ?>" alt="">
        </div>
    </div>
    <?php //endif; 
    ?>
    <div class="testimonial-main-container container">
        <div class="section-header">
            <h3 class="section-text-over-title"><?php echo $what_client_say['text_over_title']; ?></h3>
            <h1 class="section-title section-title-light">
                <?php echo $what_client_say['title']; ?>
            </h1>
            <p class="section-subtitle-light"><?php echo $what_client_say['sub_title']; ?></p>
        </div>

        <div class="section-contents">
            <div class="testimonial-clients-quotes <?php echo $args['page']; ?>">
                <div class="testimonial-qoute-item active <?php echo $args['page']; ?>">
                    <div class="client-video-message-wrap">
                        <object data='<?php echo $testimonial['clients_video_message']; ?>?autoplay=1' width='560px'></object>
                    </div>
                    <div class="testimonial-qoute-wrap">
                        <div class="clients-quote">
                            <span class="testimonail-quote-icon"><img src="<?php echo get_stylesheet_directory_uri() . '/public/img/apos.svg'; ?>" alt=""></span>
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
            </div>
        </div>
    </div>
</div>