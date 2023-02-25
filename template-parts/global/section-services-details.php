<?php
$how_we_do_it = get_field('how_we_do_it');
$why_us = get_field('why_us');
?>
<div class="site-top-service-details-section">
    <div class="section-container container how-we-do-it-container">
        <div class="section-header">
            <h1 class="section-title section-title-dark">
                <?php echo $how_we_do_it['title']; ?>
            </h1>
            <p class="section-subtitle-dark"><?php echo $how_we_do_it['description']; ?></p>
            <span class="section-bottom-line"></span>
        </div>
        <div class="section-contents">
            <div class="row">
                <div class="col col--sm-12 col--md-6 col--lg-6">
                    <div class="how-we-do-it-graphichs">
                        <img src="<?php echo $how_we_do_it['left_image']; ?>" alt="">
                    </div>
                </div>
                <div class="col col--sm-12 col--md-6 col--lg-6 col-right-points">
                    <div class="how-we-do-it-points">
                        <?php foreach ($how_we_do_it['right_points'] as $key => $point) : ?>
                            <div class="point-item">
                                <p class="point-title"><?php echo $point['title']; ?></p>
                                <p class="point-details"><?php echo $point['details']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="down-multiarrow">
        <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/multiarrow_down.svg'; ?>" alt="">
    </div>
    <div class="section-container container why-us-container">
        <div class="section-header">
            <h1 class="section-title section-title-dark">
                <?php echo $why_us['title']; ?>
            </h1>
            <p class="section-subtitle-dark"><?php echo $why_us['description']; ?></p>
            <span class="section-bottom-line"></span>
        </div>
        <div class="section-contents">
            <div class="row">
                <div class="col col--sm-12 col--md-7 col--lg-6 col-left-points">
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
                                    <p class="point-details"><?php echo $point['details']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col col--sm-12 col--md-5 col--lg-6">
                    <div class="why-us-graphichs">
                        <img src="<?php echo $why_us['right_image']; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>