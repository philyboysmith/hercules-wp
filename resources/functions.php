<?php

/**
 * Do not edit anything in this file unless you know what you're doing.
 */
use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors.
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/*
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/*
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/*
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/*
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/*
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);

    add_action('init', 'my_add_shortcodes');

    function my_add_shortcodes()
    {
        add_shortcode('login-form', 'my_login_form_shortcode');
    }

    function my_login_form_shortcode()
    {
        if (is_user_logged_in()) {
            return '';
        }

        return wp_login_form(array('echo' => false, 'redirect' => 'http://hercules.test/login/'));
    }

    function admin_login_redirect($redirect_to, $request, $user)
    {
        global $user;

        if (isset($user->roles) && is_array($user->roles)) {
            if (in_array('administrator', $user->roles)) {
                return $redirect_to;
            } else {
                return home_url();
            }
        } else {
            return $redirect_to;
        }
    }

     add_filter('login_redirect', 'admin_login_redirect', 10, 3);

     show_admin_bar(false);

     function remove_private_prefix($title)
     {
         $title = str_replace('Private: ', '', $title);

         return $title;
     }
    add_filter('the_title', 'remove_private_prefix');

    // Register Custom Steering Group
function steering_group()
{
    $labels = array(
        'name' => _x('Meetings', 'Steering Group General Name', 'text_domain'),
        'singular_name' => _x('Meeting', 'Steering Group Singular Name', 'text_domain'),
        'menu_name' => __('Steering Groups', 'text_domain'),
        'name_admin_bar' => __('Steering Group', 'text_domain'),
        'archives' => __('Meeting Archives', 'text_domain'),
        'attributes' => __('Meeting Attributes', 'text_domain'),
        'parent_item_colon' => __('Parent Meeting:', 'text_domain'),
        'all_items' => __('All Meetings', 'text_domain'),
        'add_new_item' => __('Add New Meeting', 'text_domain'),
        'add_new' => __('Add New', 'text_domain'),
        'new_item' => __('New Meeting', 'text_domain'),
        'edit_item' => __('Edit Meeting', 'text_domain'),
        'update_item' => __('Update Meeting', 'text_domain'),
        'view_item' => __('View Meeting', 'text_domain'),
        'view_items' => __('View Meetings', 'text_domain'),
        'search_items' => __('Search Meeting', 'text_domain'),
        'not_found' => __('Not found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
        'featured_image' => __('Featured Image', 'text_domain'),
        'set_featured_image' => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image' => __('Use as featured image', 'text_domain'),
        'insert_into_item' => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list' => __('Meetings list', 'text_domain'),
        'items_list_navigation' => __('Meetings list navigation', 'text_domain'),
        'filter_items_list' => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label' => __('Meeting', 'text_domain'),
        'description' => __('Steering Group Meetings', 'text_domain'),
        'labels' => $labels,
        'supports' => array('title', 'editor'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-calendar-alt',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'show_in_rest' => true,

        'can_export' => false,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('steering_group', $args);
}
add_action('init', 'steering_group', 0);

add_filter('enter_title_here', 'custom_enter_title');

function custom_enter_title($input)
{
    if ('steering_group' === get_post_type()) {
        return __('Enter meeting date as 2019-12-31');
    }

    return $input;
}

// add categories for attachments

function add_categories_for_attachments()
{
    register_taxonomy_for_object_type('category', 'attachment');
}

    add_action('init', 'add_categories_for_attachments');

    function my_acf_upload_prefilter($errors, $file, $field)
    {
        // only allow admin
        if (!current_user_can('manage_options')) {
            // this returns value to the wp uploader UI
            // if you remove the ! you can see the returned values
            $errors[] = 'test prefilter';
            $errors[] = print_r($_FILES, true);
            $errors[] = $_FILES['async-upload']['name'];
        }
        //this filter changes directory just for item being uploaded
        add_filter('upload_dir', 'my_upload_directory');

        // return
        return $errors;
    }
    add_filter('acf/upload_prefilter/name=file', 'my_acf_upload_prefilter', 10, 3);

    function my_upload_directory($param)
    {
        $param['path'] = SG_PATH;

        // if you need a different location you can try one of these values
        /*
            error_log("path={$param['path']}");
            error_log("url={$param['url']}");
            error_log("subdir={$param['subdir']}");
            error_log("basedir={$param['basedir']}");
            error_log("baseurl={$param['baseurl']}");
            error_log("error={$param['error']}");
        */

        return $param;
    }

// Start the download if there is a request for that
function monkey_download_file()
{
    if (isset($_GET['attachment']) && isset($_GET['download_file'])) {
        $attachment = get_post($_GET['attachment']);
        $parent = get_post($attachment->post_parent);
        if (($parent && $parent->post_type == 'steering_group') && !is_user_logged_in()) {
            return false;
        }
        header('Content-Type: '.$attachment->post_mime_type);
        header('Content-Transfer-Encoding: Binary');
        header('Content-disposition: attachment; filename="'.basename($attachment->guid).'"');
        readfile(SG_PATH.'/'.basename($attachment->guid)); // do the double-download-dance (dirty but worky)
    }
}
  add_action('init', 'monkey_download_file');

  function my_login_logo()
  {
      ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(/wp-content/themes/hercules/dist/images/logo.svg);
		height:47px;
		width:272px;
		background-size: 272px 47px;
		background-repeat: no-repeat;
            padding-bottom: 0;
            margin-bottom: 1rem;
        }
    </style>
<?php
  }
add_action('login_enqueue_scripts', 'my_login_logo');
