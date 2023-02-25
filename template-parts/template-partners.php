<?php

/*
* Template Name: Technology Partners
* Design and developed by : shiam
*/


get_header();

?>
<main class="main" role="main">
  <div class="site-partner-container">

    <?php
     global $post;
     $partner_hero=get_field('hero_section',$post->ID);
     $services_partner=get_field('services_partners_section',$post->ID);
     ?>

    <div class="site-partner-top-sections section-top-bg">
      <div class='site-top-upper-bg-wrapper'>
        <div class='site-top-upper-bg-container '>
          <div class='bg-inner-container'>
            <img class='top-bg' src="<?php echo get_stylesheet_directory_uri() . '/public/img/top.png'; ?>" alt="">
            <img class='left-bg' src="<?php echo get_stylesheet_directory_uri() . '/public/img/left.png'; ?>" alt="">
            <img class='right-bg' src="<?php echo get_stylesheet_directory_uri() . '/public/img/right.png'; ?>" alt="">
            <img class='bottom-bg' src="<?php echo get_stylesheet_directory_uri() . '/public/img/bottom.png'; ?>" alt="">
          </div>
        </div>
        <div class="site-top-hero-section container">

          <div class="hero-title-container text-center">
            <h1 class="section-title section-title-dark"><?php echo $partner_hero['hero_title'] ?></h1>
            <p class="hero-description"><?php echo $partner_hero['hero_subtitle'] ?></p>
            <span class="section-bottom-line"></span>
          </div>

          <div class="hero-partner-container container">
            <div class='partner-item-container'>
              <?php
              if( $partner_hero['partner_item'] ):
                foreach ($partner_hero['partner_item'] as $key => $value) :
                  ?>
              <div class='partner-item'>
                <div class='partner-item-img'>
                  <img src="<?php echo $value['partner_logo']['url'] ?>" alt="">
                </div>
                <div class='partner-border'></div>
                <div class='partner-item-content'>
                  <p><?php echo $value['partner_information'] ?></p>
                </div>
                <div class='partner-item-cta'>
                  <a target="_blank"  href="<?php echo $value['partner_website'] ?>" class='button-stroked'><?php echo __('Visit website','echologyx') ?></a>
                </div>
              </div>
              <?php
                endforeach;
              endif;
                 ?>
            </div>
          </div>

        </div>
      </div>


    </div>
    <div class='site-partner-services-section container'>

      <div class='site-partner-title-container text-center'>
        <h3 class="section-text-over-title"><?php echo $services_partner['services_partner_top_text'] ?></h3>
        <h1 class="section-title section-title-light"><?php echo $services_partner['services_partners_title'] ?></h1>
        <p class="partner-services-description "><?php echo $services_partner['services_partners_description'] ?></p>
        <span class="section-bottom-line"></span>
      </div>

      <div class="services-partner-container container">
        <div class='partner-item-container'>
          <?php
          if( $partner_hero['partner_item'] ):
            foreach ($services_partner['partner_item'] as $key => $value) :
              ?>
              <div class='partner-item'>
                <div class='partner-item-img'>
                  <img src="<?php echo $value['partner_logo']['url'] ?>" alt="">
                </div>
                <div class='partner-border'></div>
                <div class='partner-item-content'>
                  <p><?php echo $value['partner_information'] ?></p>
                </div>
                <div class='partner-item-cta'>
                  <p class='phone'><a href="tel:<?php echo $value['partner_phone_number'] ?>"><?php echo $value['partner_phone_number'] ?></a></p>
                  <p class='country'><?php echo $value['partner_country'] ?></p>
                  <a target="_blank"  href="<?php echo $value['partner_website'] ?>" class='button-stroked'><?php echo __('Visit website','echologyx') ?></a>
                </div>
              </div>
              <?php
            endforeach;
          endif;
             ?>
        </div>
      </div>

    </div>
    <?php get_template_part( 'template-parts/global/section', 'have-query', ['page' => $post->post_name] ); ?>
</main>

<?php get_footer(); ?>
