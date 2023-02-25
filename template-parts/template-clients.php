<?php

/*
* Template Name: Clients page
*/

get_header();

?>
<main class="main" role="main">
    <div class="site-client-container">

        <?php while (have_posts()) : the_post();
            global $post; ?>

            <?php
            $client_hero = get_field('hero');
            $client_args = array(
                'posts_per_page' => $client_hero['number_of_clients'],
                'offset'           => 0,
                'orderby'          => 'date',
                'order'            => 'ASC',
                'post_type'        => 'echologyx_clients',
                'post_status'      => 'publish',
                'suppress_filters' => true
            );
            $client_query = new WP_Query($client_args);
            $client_members = [];
            foreach ($client_query->posts as $key => $tpost) {
                $client_members[$tpost->ID]['client_logo'] = get_field("client_logo", $tpost->ID);
                $client_members[$tpost->ID]['service_types'] = get_the_terms($tpost->ID, 'service_types');
            }
            $locations = [
                'NewYork' => 'New York',
                //'California' => 'California',
                'Dublin' => 'Dublin',
                'Paris' => 'Paris',
                //'Madrid' => 'Madrid',
                'Vancouver' => 'Vancouver',
                'Dhaka' => 'Dhaka',
                'Manchester' => 'Leeds|Manchester',
                'London' => 'London|Birmingham|Brighton',
                // 'Leeds' => 'Leeds',
                // 'Birmingham' => 'Birmingham',
                // 'Brighton' => 'Brighton',
                'Mannheim' => 'Mannheim',
                'Amsterdam' => 'Amsterdam',
                'Tallinn' => 'Tallinn',
                'Dubai' => 'Dubai',
                'Sydney' => 'Sydney',
                'Auckland' => 'Auckland',
                'AustinTX' => 'Austin, TX',
                'SanFrancisco' => 'San Francisco',
                'Toronto' => 'Toronto',
                'Montreal' => 'Montreal',
            ];
            ?>
            <div class="site-client-top-sections">
                <div class="section-header">
                    <div class="global-map-container">
                        <?php foreach ( $locations as $key => $value ) { 
                            $location_names = explode('|', $value);
                            ?>
                            <div id="<?php echo $key; ?>" class="client-map-loaction <?php echo count($location_names) > 1 ? 'has-multiple' : ''; ?>">
                                <?php foreach ( $location_names as $key => $location_name ) : ?>
                                    <span><?php echo $location_name; ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php }?>
                        <div class="map-image-container">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/public/img/map.png'; ?>" alt="">
                        </div>
                    </div>
                    <div class="client-hero-title-container">
                        <h1 class="section-title section-title-dark">
                            <?php echo $client_hero['hero_title']; ?>
                        </h1>
                        <p class="section-subtitle-dark"><?php echo $client_hero['hero_subtitle']; ?></p>
                        <span class="section-bottom-line"></span>
                    </div>
                </div>

                <div class="section-contents container">
                    <div class="client-grid post-grid">
                        <?php foreach ( $client_members as $key => $client_member ) : ?>
                            <div class="client-grid-item post-grid-item new-loaded">
                                <div class="client-logo">
                                    <img src="<?php echo $client_member['client_logo']; ?>" alt="">
                                    <!-- <div class="item-bottom-arrow"></div> -->
                                </div>
                                <div class="client-info">
                                    <!-- <p class="services-text">Services</p> -->
                                    <ul class="clients-services">
                                        <?php foreach ( $client_member['service_types'] as $key => $client_service_type ) : ?>
                                            <li><?php echo $client_service_type->name; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if( $client_query->found_posts > $client_query->post_count ) : ?>
                        <div class="load-more-container">
                            <a href="" data-count="<?php echo $client_query->post_count; ?>" data-page="1" data-type="echologyx_clients" data-numberofpost="<?php echo $client_hero['number_of_clients']; ?>" class="load-more-button button-stroked"><?php echo $client_hero['cta_text']; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php get_template_part('template-parts/global/section', 'testimonial', ['page' => $post->post_name, 'type' => 'simple']); ?>
            <?php get_template_part( 'template-parts/global/section', 'have-query', ['page' => $post->post_name] ); ?>
        <?php endwhile; ?>

    </div>
</main>

<script type="text/html" id="tmpl-post_grid_items">
    <# if ( data.count ) { #>
        <# for ( r in data.posts_data ) { #>
            <div class="client-grid-item post-grid-item new-load">
                <div class="client-logo">
                    <img src="{{data.posts_data[r].client_logo}}" alt="">
                    <!-- <div class="item-bottom-arrow"></div> -->
                </div>
                <div class="client-info">
                    <!-- <p class="services-text">Services</p> -->
                    <ul class="clients-services">
                        <# for ( s in data.posts_data[r].service_types ) { #>
                            <li>{{data.posts_data[r].service_types[s].name}}</li>
                            <# } #>
                    </ul>
                </div>
            </div>
            <# } #>
        <# } #>
</script>

<?php get_footer(); ?>