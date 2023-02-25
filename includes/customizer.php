<?php
function echologyx_customize_register( $wp_customize ){

    //Echologyx misc settings
    
    $wp_customize->add_section('echologyx_misc', array(
        'title'    => __('Echologyx Misc Settings', 'echologyx'),
        'priority' => 60,
    ));

    $wp_customize->add_setting('echologyx_misc[contact_url]', array(
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('contact_url', array(
        'settings' => 'echologyx_misc[contact_url]',
        'label'    => __('Contact URL', 'echologyx'),
        'section'  => 'echologyx_misc',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('echologyx_misc[footer_text]', array(
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('footer_text', array(
        'settings' => 'echologyx_misc[footer_text]',
        'label'    => __('Footer Copyright Text', 'echologyx'),
        'section'  => 'echologyx_misc',
        'type'     => 'text',
    ));


    //Hubspot settings
    $wp_customize->add_section('hubspot_settings', array(
        'title'    => __('Hubspot Settings', 'echologyx'),
        'priority' => 61,
    ));

    $wp_customize->add_setting('hubspot_settings[api_key]', array(
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('api_key', array(
        'settings' => 'hubspot_settings[api_key]',
        'label'    => __('Hubspot API Key', 'echologyx'),
        'section'  => 'hubspot_settings',
        'type'     => 'text',
    ));
    
}

add_action('customize_register', 'echologyx_customize_register');