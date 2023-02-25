<?php
$our_clients = get_field('our_clients');
?>
<div class="site-global-clients-section">
    <div class="site-global-clients-container container">
        <div class="section-header">
            <h3 class="section-text-over-title"><?php echo $our_clients['text_over_title']; ?></h3>
            <h1 class="section-title section-title-dark">
                <?php echo $our_clients['title']; ?>
            </h1>
            <p class="section-subtitle-dark"><?php echo $our_clients['paragraph']; ?></p>
            <span class="section-bottom-line"></span>
        </div>

        <div class="section-contents">
            <div class="client-type-filter-list">
                <?php
                $service_types = get_terms(array(
                    'taxonomy' => 'service_types',
                    'hide_empty' => false,
                ));
                $clients_args = array(
                    'posts_per_page'   => -1,
                    'offset'           => 0,
                    'orderby'          => 'date',
                    'order'            => 'ASC',
                    'post_type'        => 'echologyx_clients',
                    'post_status'      => 'publish',
                    'suppress_filters' => true
                );
                $clients = new WP_Query($clients_args);
                ?>
                <ul class="type-filter-list">
                    <li class="service-type-terms-filter active" data-term_id="all">All</li>
                    <?php foreach ($service_types as $key => $service_type) : ?>
                        <li class="service-type-terms-filter" data-term_id="<?php echo $service_type->term_id; ?>"><?php echo $service_type->name; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="client-brands-logo-cotainers">
                <?php if ($clients->have_posts()) : ?>
                    <?php while ($clients->have_posts()) : $clients->the_post(); ?>
                        <?php
                        $client_logo = get_field('client_logo', get_the_ID());
                        ?>
                        <div class="client-brand-logo-item">
                            <img src="<?php echo $client_logo; ?>" alt="">
                        </div>
                    <?php endwhile;
                    wp_reset_query(); ?>
                <?php endif;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/html" id="tmpl-client_brand_logo_items">
    <# if ( data.count ) { #>
        <# for ( r in data.posts_data ) { #>
            <div class="client-brand-logo-item new-load">
                <img src="{{data.posts_data[r].client_logo}}" alt="">
            </div>
        <# } #>
    <# }  #>
</script>