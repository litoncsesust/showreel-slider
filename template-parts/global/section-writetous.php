<?php
$write_to_us = get_field('write_to_us');
$hubspot = get_field("hubspot");
$reCaptcha = get_field('recaptcha_settings', 'option');
?>
<div class="site-landing-write-to-us-section">
    <div class="write-to-us-main-container container">
        <div class="section-header">
            <h3 class="section-text-over-title"><?php echo $write_to_us['text_over_title']; ?></h3>
            <h1 class="section-title section-title-light">
                <?php echo $write_to_us['title'] ?>
            </h1>
            <!-- <div class="sale-bubble">
                <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/sale.png'; ?>" alt="">
                <div class="sale-bubble-text-wrap">
                    <h3><?php echo $write_to_us['discount_percentage'] ?></h3>
                    <p>on first project</p>
                </div>
            </div> -->
        </div>

        <div class="section-contents">
            <div class="write-to-us-form-container">
                <?php if ($hubspot['portal_id'] && $hubspot['form_id']) : ?>
                    <script>
                    hbspt.forms.create({
                        target: ".write-to-us-form-container",
                        portalId: '<?php echo $hubspot['portal_id'] ?: ''; ?>',
                        formId: '<?php echo $hubspot['form_id'] ?: ''; ?>'
                    });
                    </script>
                <?php else : ?>
                    <p class="write-to-us-submission-message"></p>
                <form action="" class="write-to-us-form">
                    <input type="hidden" name="action" value="submit_to_hubspot">
                    <input type="hidden" name="hubspot[portal_id]" value="<?php echo $hubspot['portal_id'] ?: ''; ?>">
                    <input type="hidden" name="hubspot[form_id]" value="<?php echo $hubspot['form_id'] ?: ''; ?>">
                    <?php wp_nonce_field('submit_to_hubspot', 'submit_to_hubspot'); ?>
                    <div class="form-group row text-input-type">
                        <div class="col col--sm-12 col--md-12 col--lg-6">
                            <input name="name" type="text" class="form-input-field" placeholder="Your Name" />
                        </div>
                        <div class="col col--sm-12 col--md-12 col--lg-6">
                            <input name="email" type="text" class="form-input-field" placeholder="Email" />
                        </div>
                    </div>
                    <div class="form-group row text-input-type">
                        <div class="col col--sm-12 col--md-12 col--lg-6">
                            <input name="company" type="text" class="form-input-field" placeholder="Company" />
                        </div>
                        <div class="col col--sm-12 col--md-12 col--lg-6">
                            <input name="jobtitle" type="text" class="form-input-field" placeholder="Job Title" />
                        </div>
                    </div>
                    <div class="form-group row text-area-type">
                        <div class="col col--sm-12 col--md-12 col--lg-12">
                            <textarea class="form-textarea-field" name="message" id="" cols="30" rows="10" placeholder="Your Message" wrap="physical"></textarea>
                        </div>
                    </div>
                    <div class="form-group row recaptcha-type">
                        <div class="col col--sm-12 col--md-12 col--lg-7">
                            <?php if (in_array($post->ID, $reCaptcha['enable_recaptcha_for']) && !empty($reCaptcha['site_key'])) : ?>
                                <?php if ($reCaptcha['version'] == 'v3') : ?>
                                    <input id="g-recaptcha-response" type="hidden" name="g-recaptcha-response">
                                <?php else : ?>
                                    <div class="g-recaptcha" data-sitekey="<?php echo $reCaptcha['site_key']; ?>" data-callback="enableSubmitButton"></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col col--sm-12 col--md-12 col--lg-7">
                            <p class="write-to-us-disclaimer"><?php echo $write_to_us['form_note'] ?></p>
                        </div>
                        <div class="col col--sm-12 col--md-12 col--lg-5 contact-submit-container">
                            <button id="contact-form-send-btn" class="button-stroked button-bg-light" disabled>
                                Contact Us
                            </button>
                        </div>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php if ($reCaptcha['version'] == 'v3') : ?>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('<?php echo $reCaptcha['site_key']; ?>', {
                action: 'submit_to_hubspot'
            }).then(function(token) {
                $('#g-recaptcha-response').val(token);
                $('#contact-form-send-btn').attr('disabled', false);
            });;
        });
    </script>
<?php else : ?>
    <script>
        var enableSubmitButton = function() {
            document.getElementById('contact-form-send-btn').disabled = false;
        }
    </script>
<?php endif; ?>