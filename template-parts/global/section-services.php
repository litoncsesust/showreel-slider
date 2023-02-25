<?php
$what_we_do = get_field('what_we_do');
?>
<div class="site-top-service-section <?php echo $args['theme']; ?>">
    <div class="section-container container">
        <div class="section-header">
            <h3 class="section-text-over-title"><?php echo $what_we_do['text_over_title']; ?></h3>
            <h1 class="section-title section-title-dark">
                <?php echo $what_we_do['title']; ?>
            </h1>
            <div class="section-subtitle-dark"><?php echo $what_we_do['paragraph']; ?></div>
            <span class="section-bottom-line"></span>
        </div>

        <div class="section-contents">
            <?php if (is_array($what_we_do['services']) && count($what_we_do['services'])) : ?>
                <div class="services-grid">

                    <?php foreach ($what_we_do['services'] as $key => $service) : ?>
                        <div class="service-grid-item <?php echo $key < 1 ? 'active' : ''; ?>">
                            <a href="<?php echo $service['link'] ?: ''; ?>" class="service-item-link <?php echo $service['link'] ?: 'link-prevent-default'; ?>">
                                <div class="grid-icon">
                                    <img src="<?php echo $service['icon']; ?>" alt="">
                                </div>
                                <div class="grid-details">
                                    <h2 class="service-item-title"><?php echo $service['title']; ?></h2>
                                    <span class="section-bottom-line"></span>
                                    <div class="service-item-paragraph"><?php echo $service['paragraph']; ?></div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>
            <a href="<?php echo $what_we_do['cta_url']; ?>" class="explore-serivices-button button-stroked"><?php echo $what_we_do['cta_text']; ?></a>
        </div>
    </div>
</div>