<?php

/*
* Template Name: Team page
*/

get_header();

?>
<main class="main" role="main">
    <div class="site-team-container">

        <?php while (have_posts()) : the_post();
            global $post; ?>

            <?php
            $team_hero = get_field('hero');
            $our_mission = get_field('our_mission');
            $why_choose_us = get_field('why_choose_us');
            $our_team = get_field('our_team');

            $team_args = array(
                'posts_per_page' => $our_team['number_of_member'],
                'offset'           => 0,
                'meta_key'         => 'team_sort_postion',
                'orderby'          => 'meta_value_num',
                'order'            => 'ASC',
                'post_type'        => 'team_member',
                'post_status'      => 'publish',
                'suppress_filters' => true
            );
            $team_query = new WP_Query($team_args);
            $team_members = [];
            foreach ($team_query->posts as $key => $tpost) {
                $team_members[$tpost->ID] = get_field("member_details", $tpost->ID);
            }
            ?>
            <div class="site-team-top-sections">
                <div class="section-header">
                    <h3 class="section-text-over-title"><?php echo $team_hero['text_over_title']; ?></h3>
                    <h1 class="section-title section-title-dark">
                        <?php echo $team_hero['hero_title']; ?>
                    </h1>
                </div>
                <?php if ($team_hero['group_image']) : ?>
                    <div class="section-contents container">
                        <div class="group-images-container">
                            <img src="<?php echo $team_hero['group_image']; ?>" alt="Group Image">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="section-contents container team-who-we-are-details ">
                    <div class="service-item-paragraph section-subtitle-dark container">
                        <?php echo $team_hero['details']; ?>
                    </div>
                    <span class="section-bottom-line"></span>
                </div>

                <div class="section-contents container">
                    <?php if (is_array($team_hero['details_with_images']) && count($team_hero['details_with_images'])) : ?>
                        <div class="content-rows">
                            <?php foreach ($team_hero['details_with_images'] as $key => $details_with_images) : ?>
                                <div class="content-row-item row-orient-<?php echo $details_with_images['images_position']; ?>">
                                    <?php if ($details_with_images['text']) : ?>
                                        <div class="content-row-text section-subtitle-dark">
                                            <?php echo $details_with_images['text']; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($details_with_images['images']) : ?>
                                        <div class="content-row-image">
                                            <img class="service-tools-image" src="<?php echo $details_with_images['images']; ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            <span class="section-bottom-line"></span>
                        </div>
                    <?php endif; ?>
                </div>

                

                <div class="member-info-details-overlay">
                </div>
                <div class="member-info-details-popup">
                    <span class="member-details-popup-closed">×</span>
                    <div class="member-info-details-container">
                    </div>
                </div>
            </div>

            <div class="team-contents-sections">
                <div class="section-header team-content-header container">
                    <h3 class="section-text-over-title"><?php echo $our_mission['text_over_title']; ?></h3>
                    <h1 class="section-title section-title-light">
                        <?php echo $our_mission['hero_title']; ?>
                    </h1>
                    <div class="section-subtitle-dark"><?php echo $our_mission['content']; ?></div>
                    <span class="section-bottom-line"></span>
                </div>
            </div>

            <?php get_template_part('template-parts/global/section', 'services', ['page' => $post->post_name, 'theme' => 'dark']); ?>

            <div class="team-contents-sections">
                <div class="section-header team-content-header container">
                    <h3 class="section-text-over-title"><?php echo $why_choose_us['text_over_title']; ?></h3>
                    <h1 class="section-title section-title-light">
                        <?php echo $why_choose_us['hero_title']; ?>
                    </h1>
                    <div class="section-subtitle-dark"><?php echo $why_choose_us['content']; ?></div>
                    <span class="section-bottom-line"></span>
                </div>
            </div>
            <?php get_template_part('template-parts/global/section', 'jobcounter', ['page' => $post->post_name]); ?>
            <?php get_template_part( 'template-parts/global/section', 'have-query', ['page' => $post->post_name] ); ?>
            <?php //get_template_part('template-parts/global/section', 'testimonial', ['page' => $post->post_name]); ?>
            <!-- <div class="site-team-top-sections team-member-grid-section">
                <div class="section-contents container">
                    <div class="section-header">
                        <h3 class="section-text-over-title"><?php echo $our_team['text_over_title']; ?></h3>
                        <h1 class="section-title section-title-dark">
                            <?php echo $our_team['hero_title']; ?>
                        </h1>
                        <div class="section-subtitle-dark"><?php echo $our_team['content']; ?></div>
                        <span class="section-bottom-line"></span>
                    </div>
                    <div class="team-grid post-grid">
                        <?php foreach ($team_members as $key => $team_member) : ?>
                            <div class="team-grid-item post-grid-item new-loaded" data-member_id="<?php echo $key; ?>">
                                <div class="member-avatar">
                                    <img src="<?php echo $team_member['image']; ?>" alt="">
                                </div>
                                <div class="team-member-info">
                                    <div class="team-member-wrap">
                                        <p class="member-name"><?php echo $team_member['name']; ?></p>
                                        <p class="member-designation"><?php echo $team_member['designation']; ?></p>
                                        <ul class="member-social">
                                                <?php foreach ($team_member['social'] as $key => $team_member_social) :  if (empty($team_member_social)) continue; ?>
                                                    <li><a href="<?php echo $team_member_social; ?>"><?php echo $key; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($team_query->found_posts > $team_query->post_count) : ?>
                        <div class="load-more-container">
                            <a href="" data-count="<?php echo $team_query->post_count; ?>" data-page="1" data-type="team_member" data-numberofpost="<?php echo $our_team['number_of_member']; ?>" class="load-more-button button-stroked"><?php echo $our_team['cta_text']; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div> -->
            <?php //get_template_part('template-parts/global/section', 'client', ['page' => $post->post_name]); 
            ?>

        <?php endwhile; ?>
    </div>
</main>

<script type="text/html" id="tmpl-post_grid_items">
    <# if ( data.count ) { #>
        <# for ( r in data.posts_data ) { #>
            <div class="team-grid-item post-grid-item new-load" data-member_id="{{r}}">
                <div class="member-avatar">
                    <img src="{{data.posts_data[r].image}}" alt="">
                </div>
                <div class="team-member-info">
                    <div class="team-member-wrap">
                        <p class="member-name">{{data.posts_data[r].name}}</p>
                        <p class="member-designation">{{data.posts_data[r].designation}}</p>
                        <!-- <ul class="member-social">
                            <# for ( s in data.posts_data[r].social ) { #>
                                <li><a href="{{data.posts_data[r].social[s]}}">{{s}}</a></li>
                            <# } #>
                        </ul> -->
                    </div>
                </div>
            </div>
            <# } #>
                <# } #>
</script>

<script type="text/html" id="tmpl-team_member_details">
    <# if ( data ) { #>
        <div class="member-info-details-head">
            <div class="member-avatar">
                <img src="{{data.image}}" alt="">
            </div>
            <p class="member-name">{{{data.name}}}</p>
            <p class="member-designation">{{{data.designation}}}</p>
        </div>
        <div class="member-info-details-content">
            <# if ( data.background ) { #>
                <div class="member-info-row member-info-details-background">
                    <h5>Background</h5>
                    <p>{{{data.background}}}</p>
                </div>
                <# } #>

                    <# if ( data.likes ) { #>
                        <div class="member-info-row member-info-details-likes">
                            <h5>Likes</h5>
                            <p>{{{data.likes}}}</p>
                        </div>
                        <# } #>

                            <# if ( data.dislikes ) { #>
                                <div class="member-info-row member-info-details-likes">
                                    <h5>Dislikes</h5>
                                    <p>{{{data.dislikes}}}</p>
                                </div>
                                <# } #>

                                    <# if ( data.special_skills ) { #>
                                        <div class="member-info-row member-info-details-skills">
                                            <h5>Special Skill</h5>
                                            <p>{{{data.special_skills}}}</p>
                                        </div>
                                        <# } #>
                                            <# if ( data.social ) { #>
                                                <div class="member-info-row member-info-details-social">
                                                    <h5>Social</h5>
                                                    <ul class="member-social">
                                                        <# for ( s in data.social ) { #>
                                                            <# if ( data.social[s] ) { #>
                                                                <li><a target="_blank" href="{{data.social[s]}}">{{s}}</a></li>
                                                                <# } #>
                                                                    <# } #>
                                                    </ul>
                                                </div>
                                                <# } #>
        </div>
        <# } #>
</script>

<?php get_footer(); ?>