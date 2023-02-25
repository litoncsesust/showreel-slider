<?php
$services_tools = get_field('services_tools');
?>
<div class="site-top-service-tools-section">
    <div class="section-container container">
        <div class="section-contents">
            <div class="service-tools-floating-container">
                <h1 class="service-tools-section-title"><?php echo $services_tools['title']; ?></h1>
                <p class="service-tools-description"><?php echo $services_tools['description']; ?></p>
                <p class="service-tools-title"><?php echo $services_tools['tools_title']; ?></p>
                <div class="service-tools-logos">
                    <img src="<?php echo $services_tools['tools_image']; ?>" alt="">
                </div>
                <div class="graphics-container">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/Group.png'; ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>