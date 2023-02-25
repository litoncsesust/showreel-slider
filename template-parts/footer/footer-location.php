<?php
$footer_locations = get_field('footer_locations', 'option');
?>
<div class="site-footer-location-container">
    <div class="site-footer-location-items">
        <?php foreach ( $footer_locations as $key => $footer_location ) {
            if ( empty( $footer_location['name'] ) ) continue;
        ?>
        <div class="location-item">
            <div class="location-icons">
                <img src="<?php echo $footer_location['image']; ?>" alt="">
            </div>
            <div class="location-details">
                <p class="location-name"><?php echo $footer_location['name']; ?></p>
                <p class="location-phone"><?php echo $footer_location['phone']; ?></p>
                <p class="location-phone"><?php echo $footer_location['email']; ?></p>
                <p class="location-address"><?php echo $footer_location['address']; ?></p>
            </div>
        </div>
        <?php } ?>
    </div>
</div>