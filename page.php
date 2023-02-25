<?php get_header(); ?>

<main class="main" role="main">
    <div class="container  echologyx-single-default">

        <?php while ( have_posts() ) : the_post(); ?>

            <article <?php post_class(); ?>>

                <?php the_content(); ?>

            </article>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>
