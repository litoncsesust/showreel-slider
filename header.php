<!DOCTYPE html>
<!--[if IE 8]><html <?php language_attributes(); ?> class="ie8"><![endif]-->
<!--[if lte IE 9]><html <?php language_attributes(); ?> class="ie9"><![endif]-->
<html <?php language_attributes(); ?> class="js">

<head>
    <!-- Google Tag Manager -->

    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':

                    new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],

                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =

                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);

        })(window, document, 'script', 'dataLayer', 'GTM-5CF22HM');
    </script>

    <!-- End Google Tag Manager -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="dns-prefetch" href="//google-analytics.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link rel="preload" href="<?php echo get_site_url(); ?>/wp-content/themes/echologyx/public/css/fonts/slick.woff" as="font" type="font/woff2" crossOrigin="anonymous">
    <?php
    global $post;
    $reCaptcha = get_field('recaptcha_settings', 'option');
    $hubspot_settings = get_field('hubspot_api', 'option');

    if (in_array($post->ID, $hubspot_settings['enable_hubspot_for'])) {
    ?>
        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
    <?php } ?>
    <?php wp_head(); ?>
    <!--[if lt IE 10]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script>
        <![endif]-->
    <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/livingston-css3-mediaqueries-js/1.0.0/css3-mediaqueries.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
        <![endif]-->
</head>

<body <?php body_class(); ?>>

    <!-- Google Tag Manager (noscript) -->

    <noscript><iframe src=https://www.googletagmanager.com/ns.html?id=GTM-5CF22HM height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <!-- End Google Tag Manager (noscript) -->

    <header class="header" role="banner">
        <div id="nav-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="site-header-container container">
            <div class="site-branding row">
                <div class="col col--sm-8 col--md-6 col--lg-4 echologxy-sitelogo">
                    <div class="site-logo"><?php the_custom_logo(); ?></div>
                </div>
                <div class="col col--sm-4 col--md-6 col--lg-8 echologxy-sitenav">
                    <nav class="site-nav" aria-label="<?php esc_attr_e('Header Menu', 'echologyx'); ?>">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'header',
                                    'menu_class'     => 'navbar-nav mr-auto',
                                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                )
                            );
                            ?>
                        </div>
                    </nav>
                </div>
                <div class="col col--sm-4 col--md-6 col--lg-8 echologxy-sitenav echologxy-sitenav-mobile">
                    <nav class="site-nav" aria-label="<?php esc_attr_e('Header Menu', 'echologyx'); ?>">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'header',
                                    'menu_class'     => 'navbar-nav mr-auto',
                                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                )
                            );
                            ?>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>