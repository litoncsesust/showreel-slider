<?php

/*
* Template Name: Contact page
* Design and developed by : Ahmed Shakil
*/

get_header();

?>
<main class="main" role="main">
    <div class="site-contact-container">

        <?php while (have_posts()) : the_post();
            global $post; ?>

            <?php
            $contact_us = get_field("contact_us");
            $hubspot = get_field("hubspot");
            $reCaptcha = get_field('recaptcha_settings', 'option');
            ?>
            <div class="contact-bg" style="background-image: linear-gradient(274deg, rgb(0 0 0 / 70%), rgb(0 0 0 / 70%)), url('<?php echo get_stylesheet_directory_uri() . '/public/img/contact_bg.jpg'; ?>');">


                <div class="contact-container container">
                    <div class="contact-text">
                        <h1 class="hero-title"><?php echo $contact_us['contact_us_title']; ?></h1>
                        <p class="hero-subtitle"><?php echo $contact_us["contact_us_description"]; ?></p>
                        <div class="catch-up">
                            <small><?php echo $contact_us["contact_us_below_title"] ?></small>
                            <div class="graphics-container">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/Group.png'; ?>" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="cantact-form">
                        <div class="write-to-us-form-container">
                        <script>
                            hbspt.forms.create({
                                target: ".write-to-us-form-container",
                                portalId: '6624358',
                                formId: '009032fe-6a54-4f45-9ed7-21eeb7db997b',
                            });
                        </script>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>