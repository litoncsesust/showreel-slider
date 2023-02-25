        <?php
        $echologyx_misc = get_theme_mod('echologyx_misc');
        ?>

        <footer class="footer-homepage" role="contentinfo">
            <div class="site-footer-container container">
                <?php
                get_template_part('template-parts/footer/footer', 'location');
                $social_links = get_field('social_links', 'option');
                ?>
                <div class="site-footer-nav-menu-container">
                    <div class="site-footer-social-icons">
                        <ul class="site-social-icon-list">
                        <?php foreach ( $social_links as $key => $social_link ) {
                            if ( empty( $social_link['url'] ) ) continue;
                        ?>
                            <li><a href="<?php echo $social_link['url']; ?>"><img src="<?php echo $social_link['icon']; ?>" alt=""></a></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <div class="site-footer-nave-menu">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer',
                                'menu_class'     => 'navbar-nav mr-auto',
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            )
                        );
                        ?>
                        <p class="site-copyrite-text"><?php echo $echologyx_misc['footer_text']; ?></p>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
        </body>

        </html>