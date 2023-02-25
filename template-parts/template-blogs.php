<?php

/*
* Template Name: Blogs page
*/

get_header();

?>
<main class="main" role="main">
    <div class="site-blog-container">

        <?php while (have_posts()) : the_post();
            global $post; ?>

            <?php
            $blog_hero = get_field('hero');
            $blogs_categories = get_terms(array(
                'taxonomy' => 'category',
                'hide_empty' => true,
            ));

            $blog_args = array(
                'posts_per_page' => $blog_hero['number_of_blogs'],
                'offset'           => 0,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'post_type'        => 'post',
                'post_status'      => 'publish',
                'suppress_filters' => true
            );
            $blog_query = new WP_Query($blog_args);
            ?>
            <div class="site-blog-top-sections">
                <div class="section-header">
                    <h1 class="section-title section-title-dark">
                        <?php echo $blog_hero['hero_title']; ?>
                    </h1>
                    <p class="section-subtitle-dark"><?php echo $blog_hero['hero_subtitle']; ?></p>
                    <span class="section-bottom-line"></span>
                </div>

                <div class="blogs-category-filter container">
                    <ul class="blog-category-filter-list">
                        <li class="category-item active" data-count="0" data-taxonomy="category" data-term_id="all" data-page="0" data-type="post" data-numberofpost="<?php echo $blog_hero['number_of_blogs']; ?>">All</li>
                        <?php foreach ($blogs_categories as $key => $blog_category) : ?>
                            <li class="category-item" data-count="0" data-taxonomy="category" data-term_id="<?php echo $blog_category->term_id; ?>" data-page="0" data-type="post" data-numberofpost="<?php echo $blog_hero['number_of_blogs']; ?>"><?php echo $blog_category->name; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="section-contents container">
                    <div class="blog-grid post-grid">
                        <?php foreach ($blog_query->posts as $key => $tpost) {
                            $blog_categories = get_the_terms($tpost->ID, 'category');
                        ?>
                            <div class="blog-grid-item post-grid-item new-loaded">
                                <a href="<?php echo get_the_permalink($tpost->ID); ?>">
                                    <div class="blog-logo">
                                        <img src="<?php echo get_the_post_thumbnail_url($tpost->ID); ?>" alt="">
                                    </div>
                                </a>
                                <div class="blog-info">
                                    <a href="<?php echo get_the_permalink($tpost->ID); ?>"><h3 class="blog-info-title"><?php echo get_the_title($tpost->ID); ?></h3></a>
                                    <ul class="blogs-categories">
                                        <?php foreach ($blog_categories as $key => $blog_category) : ?>
                                            <li><?php echo $blog_category->name; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if( $blog_query->found_posts > $blog_query->post_count ) : ?>
                        <div class="load-more-container">
                            <a href="" data-count="<?php echo $blog_query->post_count; ?>" data-taxonomy="category" data-term_id="" data-page="1" data-type="post" data-numberofpost="<?php echo $blog_hero['number_of_blogs']; ?>" class="load-more-button button-stroked"><?php echo $blog_hero['cta_text']; ?></a>
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
            <div class="blog-grid-item post-grid-item new-load">
                <a href="{{data.posts_data[r].blog_url}}">
                    <div class="blog-logo">
                        <img src="{{data.posts_data[r].blog_logo}}" alt="">
                    </div>
                </a>
                <div class="blog-info">
                    <a href="{{data.posts_data[r].blog_url}}"><h3 class="blog-info-title">{{{data.posts_data[r].blog_title}}}</h3></a>
                    <ul class="blogs-categories">
                        <# for ( c in data.posts_data[r].blog_categories ) { #>
                            <li>{{data.posts_data[r].blog_categories[c].name}}</li>
                        <# } #>
                    </ul>
                </div>
            </div>
            <# } #>
                <# } #>
</script>

<?php get_footer(); ?>