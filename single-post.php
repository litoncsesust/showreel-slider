<?php get_header(); ?>

<main class="main" role="main">
    <div class="container echologyx-blog-post">
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $author_id = get_the_author_meta('ID');
                $author_team_post = get_field('assigned_team_member', "user_" . $author_id);
                $author_team_info = get_field("member_details", $author_team_post);
                ?>
                <div class="col col--sm-12 col--md-12 col--lg-7">
                    <article <?php post_class('echologyx-blog-post-article'); ?>>

                        <header class="post__header" role="heading">
                            <h1 class="hero-title"><?php the_title(); ?></h1>
                            <div class="blog-post-banner">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                            </div>
                            <div class="blog-author-info">
                                <div class="author-avatar">
                                    <img src="<?php echo $author_team_info['image']; ?>" alt="">
                                </div>
                                <div class="author-name">
                                    <p><?php echo $author_team_info['name'] ?: ''; ?> <span class="author-degignation"><?php echo $author_team_info['designation'] ?: ''; ?></span></p>
                                </div>
                                <div class="author-social">
                                    <ul class="member-social">
                                        <?php
                                        if (isset($author_team_info['social']) && is_array($author_team_info['social'])) :
                                            foreach ($author_team_info['social'] as $key => $team_member_social) : if (empty($team_member_social)) continue;
                                        ?>
                                                <li><a target="_blank" href="<?php echo $team_member_social; ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/public/img/' . $key . '.svg'; ?>" alt=""></a></li>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </header>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                
                        <footer class="post__footer">
                            <p class="post__date"><time><?php echo human_time_diff(strtotime($post->post_date)) . ' ' . __('ago'); ?></time></p>
                        </footer>

                    </article>
                </div>
                <div class="col col--sm-12 col--md-12 col--lg-5 side-sticky-section">
                    <?php
                    $recent_blogs_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 5,
                        'orderby' => 'date',
                        'post_status' => 'publish',
                        'post__not_in' => array (get_the_ID()),
                        'order' => 'DESC'
                    );
                    $recent_blogs_query = new WP_Query($recent_blogs_args);
                    ?>

                    <div class="recent-blogs-sticky">
                        <h3 class="sticky-blogs-title">Recent Blogs</h3>
                        <div class="recent-blogs-list">

                            <?php foreach ($recent_blogs_query->posts as $key => $tpost) {
                                $blog_categories = get_the_terms($tpost->ID, 'category');
                                $blog_thumb = get_the_post_thumbnail_url($tpost->ID);
                            ?>
                                <div class="recent-blog-list-item">
                                    <div class="blog-banner-container">
                                        <?php if( $blog_thumb ) : ?>
                                            <img src="<?php echo $blog_thumb; ?>" alt="Image Not Found">
                                        <?php endif; ?>
                                    </div>
                                    <div class="blog-details-container">
                                        <a href="<?php echo get_the_permalink($tpost->ID); ?>">
                                            <h3 class="blog-info-title"><?php echo get_the_title($tpost->ID); ?></h3>
                                        </a>
                                        <ul class="blogs-categories">
                                            <?php foreach ($blog_categories as $key => $blog_category) : ?>
                                                <li><?php echo $blog_category->name; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>


            <?php endwhile; ?>
        </div>
    </div>
    <?php get_template_part('template-parts/global/section', 'testimonial-single', ['page' => 'single-blog']); ?>
    <?php get_template_part( 'template-parts/global/section', 'have-query', ['page' => $post->post_name] ); ?>
</main>

<?php get_footer(); ?>