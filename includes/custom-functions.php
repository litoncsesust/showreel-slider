<?php

/**
 * This is file for all of your custom functions for the project
 */

/**
 * Logger
 */
function echo_log($message)
{
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}

/**
 * Add Contact Us Menu button
 */

function add_contact_us_button($items, $args)
{
    $echologyx_misc = get_theme_mod('echologyx_misc');
    if ($args->theme_location == 'header') {
        return $items .= '<li class="nav-contact-us"><a class="button-filled" href="' . $echologyx_misc['contact_url'] . '" role="button" data-toggle="modal">Contact Us</a></li>';
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'add_contact_us_button', 10, 2);

/**
 * Filter clients by category
 */
function filter_client_by_service()
{
    $term_id = $_POST['term_id'];
    $response = [];

    if ($term_id != 'all') {
        $args = array(
            'numberposts'      => -1,
            'tax_query' => [
                [
                    'taxonomy' => 'service_types',
                    'terms' => $term_id,
                ],
            ],
            'post_type' => 'echologyx_clients',
            'order'     => 'ASC',
            'orderby'   => 'date',
        );
    } else {
        $args = array(
            'numberposts'      => -1,
            'post_type' => 'echologyx_clients',
            'post_type' => 'echologyx_clients',
            'order'     => 'ASC',
            'orderby'   => 'date',
        );
    }

    $posts = get_posts($args);

    if (count($posts)) {
        $response['count'] = count($posts);

        foreach ($posts as $key => $post) {
            $response['posts_data'][$key] = [
                'client_logo' => get_field('client_logo', $post->ID),
                'service_types' => get_the_terms($post->ID, 'service_types')
            ];
        }
    }

    wp_send_json($response);
}

add_action("wp_ajax_filter_client_by_service", "filter_client_by_service");
add_action("wp_ajax_nopriv_filter_client_by_service", "filter_client_by_service");


/**
 * Load more team member
 */
function load_more_posts()
{
    $offset = $_POST['offset'];
    $type = $_POST['type'];
    $taxonomy = $_POST['taxonomy'];
    $term_id = $_POST['term_id'];
    $numberofpost = $_POST['numberofpost'];
    $response = [];

    $post_args = array(
        'posts_per_page' => $numberofpost,
        'offset'           => $offset,
        'orderby'          => 'date',
        'order'            => 'ASC',
        'post_type'        => $type,
        'post_status'      => 'publish',
        'suppress_filters' => true
    );
    if ($type == 'team_member') {
        $post_args['meta_key'] = 'team_sort_postion';
        $post_args['orderby'] = 'meta_value_num';
    }
    if ($type == 'post') {
        $post_args['order'] = 'DESC';
    }
    if ($taxonomy != "undefined" && $term_id != 'all' && $term_id != "") {
        $post_args['tax_query'] = array(
            array(
                'taxonomy'         => $taxonomy,
                'terms'            => array($term_id),
                'field'            => 'term_id',
                'operator'         => 'IN',
            ),
        );
    }

    $post_query = new WP_Query($post_args);
    $posts_data = [];

    if (count($post_query->posts)) {

        $response['count'] = $post_query->post_count;
        $response['found'] = $post_query->found_posts;
        foreach ($post_query->posts as $key => $tpost) {
            switch ($type) {
                case 'team_member':
                    $posts_data[$tpost->ID] = get_field("member_details", $tpost->ID);
                    break;
                case 'echologyx_clients':
                    $posts_data[$tpost->ID]['client_logo'] = get_field("client_logo", $tpost->ID);
                    $posts_data[$tpost->ID]['service_types'] = get_the_terms($tpost->ID, 'service_types');
                    break;
                case 'post':
                    $posts_data[$tpost->ID]['blog_logo'] = get_the_post_thumbnail_url($tpost->ID);
                    $posts_data[$tpost->ID]['blog_title'] = get_the_title($tpost->ID);
                    $posts_data[$tpost->ID]['blog_url'] = get_the_permalink($tpost->ID);
                    $posts_data[$tpost->ID]['blog_categories'] = get_the_terms($tpost->ID, 'category');
                    break;
                default:
                    # code...
                    break;
            }
        }
        $response['posts_data'] = $posts_data;
    }

    wp_send_json($response);
}

add_action("wp_ajax_load_more_posts", "load_more_posts");
add_action("wp_ajax_nopriv_load_more_posts", "load_more_posts");


/**
 * Submit form to hubspot
 */
function submit_to_hubspot()
{
    $response = [];
    if (
        !isset($_POST['submit_to_hubspot'])
        || !wp_verify_nonce($_POST['submit_to_hubspot'], 'submit_to_hubspot')
    ) {
        $response['error'] = true;
        $response['message'] = __("Something went wrong!", 'echologyx');
    } else {
        $reCaptcha = get_field('recaptcha_settings', 'option');
        $secret = $reCaptcha['site_secret'];
        $verifyResponse = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']), true);
        if ($verifyResponse['success']) {
            $hubspot_settings = get_field('hubspot_api', 'option');
            $hs_key = $hubspot_settings['api_key'];
            if (!empty($hs_key)) {
                unset($_POST['action']);

                $name = explode(' ', $_POST['name']);

                $_POST['firstname'] = $_POST['name'];
                $_POST['lastname'] = '';

                unset($_POST['name']);

                unset($_POST['submit_to_hubspot']);
                unset($_POST['_wp_http_referer']);
                unset($_POST['g-recaptcha-response']);

                $response['hubspot'] = $_POST['hubspot'];
                unset($_POST['hubspot']);

                $_POST['get_update'] = $_POST['subscribe_for_newsletter'];
                unset($_POST['subscribe_for_newsletter']);

                if ( $hubspot_settings['owner_id'] ) {
                    $_POST['hubspot_owner_id'] = $hubspot_settings['owner_id'];
                }

                $hubSpot = \SevenShores\Hubspot\Factory::createWithOAuth2Token($hs_key);

                $contactEndpoint = new SevenShores\Hubspot\Endpoints\Contacts($hubSpot->getClient());

                try {
                    $convertedProperties = convertPostToProperties($_POST);
                    $contact = $contactEndpoint->createOrUpdate($_POST['email'], $convertedProperties);
                } catch (\Throwable $th) {
                    log_me($th);
                }


                $_POST['subscribe_for_newsletter'] = $_POST['get_update'];
                $_POST['firstname'] = $name[0];
                $_POST['lastname'] = $name[1];
                
                $response['error'] = false;
                $response['message'] = __("Your message submitted successfully", 'echologyx');
                $response['contact'] = $contact;
                $_POST['lastname'] = '';
                unset($_POST['hubspot_owner_id']);
                $response['post'] = $_POST;
            } else {
                $response['error'] = true;
                $response['message'] = __("Something went wrong!", 'echologyx');
            }
        } else {
            $response['error'] = true;
            $response['message'] = __("Invalid reCaptcha! ( Please refresh the page )", 'echologyx');
        }
    }
    wp_send_json($response);
}

add_action("wp_ajax_submit_to_hubspot", "submit_to_hubspot");
add_action("wp_ajax_nopriv_submit_to_hubspot", "submit_to_hubspot");


/**
 * Get members details
 */
function convertPostToProperties($post)
{
    $properties = [];

    foreach ( $post as $property => $value ) {
        $properties[] = [
            'property' => $property,
            'value' => $value
        ];
    }

    return $properties;
}


/**
 * Get members details
 */
function load_member_details()
{

    if (isset($_POST['member_id']) && !empty($_POST['member_id'])) {
        $data = get_field("member_details", $_POST['member_id']);
        $data['social'] = array_filter($data['social'], function ($s) {
            return !empty($s);
        });
        if (empty($data['social'])) {
            unset($data['social']);
        }
        $response['data'] = $data;
    } else {
        $response['error'] = true;
        $response['message'] = __("Something went wrong!", 'echologyx');
    }
    wp_send_json($response);
}

add_action("wp_ajax_load_member_details", "load_member_details");
add_action("wp_ajax_nopriv_load_member_details", "load_member_details");

/**
 * Register widget areas
 *
 * @return void
 */

function echologyx_footer_area_areas()
{
    register_sidebar(
        array(
            'name'          => __('Footer Section', 'echologyx'),
            'id'            => 'footer-section',
            'description'   => __('Add widgets here to appear in your footer.', 'echologyx'),
            'before_widget' => '<div id="echologyx_footer_location_address" class="widget address-block %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '',
            'after_title'   => '',
        )
    );
}

add_action('widgets_init', 'echologyx_footer_area_areas');


acf_add_options_page(array(
    'page_title'     => __('Echologyx Theme', 'echologyx'),
    'menu_title'    => __('Echologyx Theme', 'echologyx'),
    'menu_slug'     => 'theme-general-settings',
    'capability'    => 'edit_posts',
    'redirect'        => false
));



add_action('add_meta_boxes', 'register_team_metabox');

/**
 * Register Custom Metabox
 *
 * @return void
 */
function register_team_metabox()
{
    add_meta_box(
        'team-forms-box',
        __('Extra Info', 'echologyx'),
        'render_team_form_view',
        'team_member',
        'side'
    );
}

function render_team_form_view($post)
{
    $team_sort_postion = get_post_meta($post->ID, 'team_sort_postion', true);
?>
    <div class="inside">
        <div class="acf-field acf-field-text">
            <div class="acf-label">
                <label for="">Sort Postion Number</label>
            </div>
            <div class="acf-input">
                <div class="acf-input-wrap">
                    <input type="number" name="team_sort_postion" value="<?php echo $team_sort_postion ?: 1; ?>">
                    <p class="description">Add a sort position</p>
                </div>
            </div>
        </div>
    </div>
<?php
}


add_action('save_post', 'store_team_form', 99, 3);

/**
 * Store custom metabox data
 *
 * @return void
 */
function store_team_form($post_id, $post, $update)
{
    global $wpdb;
    if ('team_member' !== $post->post_type) {
        return;
    }
    $team_sort_postion = $_POST['team_sort_postion'];
    update_post_meta($post_id, 'team_sort_postion', $team_sort_postion);
}


// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

    global $wp_version;
    if ($wp_version !== '4.7.1') {
        return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);

    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4);

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function enable_svg_upload($upload_mimes)
{
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}

add_filter('upload_mimes', 'enable_svg_upload', 10, 1);

function fix_svg()
{
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
add_action('admin_head', 'fix_svg');
