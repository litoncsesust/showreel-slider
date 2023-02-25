<?php
$how_we_do_it = get_field('how_we_do_it');
$why_us = get_field('why_us');
$services_tools = get_field('services_tools');
?>
<div class="site-top-service-details-section-v2">
    <div class="graphics-container container">
        <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/Group.png'; ?>" alt="">
    </div>

    <div class="section-container container how-we-do-it-container">
        <div class="section-header">
            <h1 class="section-title section-title-light">
                <?php echo $how_we_do_it['title']; ?>
            </h1>
            <p class="section-subtitle-dark"><?php echo $how_we_do_it['description']; ?></p>
            <span class="section-bottom-line"></span>
            <div class="service-logo">
                <img src="<?php echo $how_we_do_it['service_logo']; ?>" alt="" >
            </div>
        </div>
        <div class="section-contents">
            <div class="row">

                <div class="col col--sm-12 col--md-12 col--lg-12 col-right-points-v2">
                    <div class="how-we-do-it-points-v2">
                        <?php foreach ($how_we_do_it['right_points'] as $key => $point) : ?>
                            <div class="point-item">
                                <p class="point-title"><?php echo $point['title']; ?></p>
                                <div class="point-details"><?php echo $point['details']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if( isset( $services_tools['tools_images'] )  && is_array( $services_tools['tools_images'] ) ) : ?>
        <div class="using-tools">
            <h1 class="title"><?php echo $services_tools['title']; ?></h1>
            <div class="tool-images">
                    <?php foreach ( $services_tools['tools_images'] as $value ) : ?>
                        <div class="tool-image">
                        <img src="<?php echo $value['tool_image']; ?>" width="70%" alt="">
                    </div>
                    <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="why-up-full-container">
        <div class="down-multiarrow-v2">
            <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/multiarrow_down.svg'; ?>" alt="">
        </div>

        <div class="section-container container why-us-container-v2">
            <div class="section-header">
                <h1 class="section-title title-padding section-title-dark">
                    <?php echo $why_us['title']; ?>
                </h1>
                <?php if ( $why_us['description'] ) : ?>
                    <p class="section-subtitle-dark"><?php echo $why_us['description']; ?></p>
                <?php endif; ?>
                <span class="section-bottom-line"></span>
            </div>
            <div class="section-contents">
                <div class="row">
                    <div class="col col--sm-12 col--md-12 col--lg-12 col-left-points">
                        <div class="why-us-points">
                            <?php foreach ($why_us['left_points'] as $key => $point) : ?>
                                <div class="point-item">
                                    <div class="point-item-number">
                                        <h1 class="section-title section-title-dark">
                                            <span>0<?php echo $key + 1; ?></span>
                                        </h1>
                                    </div>
                                    <div class="point-item-content">
                                        <p class="point-title"><?php echo $point['title']; ?></p>
                                        <div class="point-details"><?php echo $point['details']; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>