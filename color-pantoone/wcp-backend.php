<?php 
if (!defined( 'ABSPATH')) exit;

// custom post type function
function wcp_create_posttype() {
 
    register_post_type( 'pantone',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Color Pantone' ),
                'singular_name' => __( 'Pantone' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'pantone'),
            'show_in_rest' => false,
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'wcp_create_posttype' );

/*
* Creating a function to create our CPT
*/
 
function wcp_custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Pantone', 'Post Type General Name', 'wcp' ),
        'singular_name'       => _x( 'Pantone', 'Post Type Singular Name', 'wcp' ),
        'menu_name'           => __( 'Pantone', 'wcp' ),
        'parent_item_colon'   => __( 'Parent Pantone', 'wcp' ),
        'all_items'           => __( 'All Pantone', 'wcp' ),
        'view_item'           => __( 'View Pantone', 'wcp' ),
        'add_new_item'        => __( 'Add New Pantone', 'wcp' ),
        'add_new'             => __( 'Add New', 'wcp' ),
        'edit_item'           => __( 'Edit Pantone', 'wcp' ),
        'update_item'         => __( 'Update Pantone', 'wcp' ),
        'search_items'        => __( 'Search Pantone', 'wcp' ),
        'not_found'           => __( 'Not Found', 'wcp' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'wcp' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'pantone', 'wcp' ),
        'description'         => __( 'Panrtone', 'wcp' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title','excerpt' ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => false,
 
    );
     
    // Registering your Custom Post Type
    register_post_type( 'pantone', $args );
 
}
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
add_action( 'init', 'wcp_custom_post_type', 0 );


/**
  Remove Wysiwyg Editor
**/

add_action('init', 'init_remove_support',100);
function init_remove_support(){
    $post_type = 'pantone';
    remove_post_type_support( $post_type, 'editor');
}

/**
  Enqueue Color Pickre Script 
**/

add_action( 'admin_enqueue_scripts', 'mytheme_backend_scripts');
if ( ! function_exists( 'mytheme_backend_scripts' ) ){
    function mytheme_backend_scripts($hook) {
        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
    }
}
add_action( 'add_meta_boxes', 'mytheme_add_meta_box' );
if ( ! function_exists( 'mytheme_add_meta_box' ) ){
    function mytheme_add_meta_box(){
        add_meta_box( 'header-page-metabox-options', esc_html__('Header Color', 'mytheme' ), 'mytheme_header_meta_box', 'pantone', 'side', 'low');
    }
}
if ( ! function_exists( 'mytheme_header_meta_box' ) ){
    function mytheme_header_meta_box( $post ){
        $custom = get_post_custom( $post->ID );
        $header_color = (isset($custom["header_color"][0])) ? $custom["header_color"][0] : '';
        wp_nonce_field( 'mytheme_header_meta_box', 'mytheme_header_meta_box_nonce' );
        ?>
 
        <script>
		jQuery(document).ready(function($){
            $('.color-field').each(function(){
                    $(this).wpColorPicker();
            });
		 });
        </script>
        <div class="pagebox">

            <p class="separator">
                <h4><?php esc_attr_e('Header Color', 'mytheme' ); ?></h4>
                <input class="color-field" type="text" name="header_color" value="<?php esc_attr_e($header_color); ?>"/>
            </p>
        </div>
        <?php
    }
}
if ( ! function_exists( 'mytheme_save_header_meta_box' ) ){
    function mytheme_save_header_meta_box( $post_id ){
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if( !current_user_can( 'edit_pages' ) ) {
            return;
        }
        if ( !isset( $_POST['header_color'] ) || !wp_verify_nonce( $_POST['mytheme_header_meta_box_nonce'], 'mytheme_header_meta_box' ) ) {
            return;
        }
        $header_color = (isset($_POST["header_color"]) && $_POST["header_color"]!='') ? $_POST["header_color"] : '';
        update_post_meta($post_id, "header_color", $header_color);
    }
}
add_action( 'save_post', 'mytheme_save_header_meta_box' );

/**
  Custom Template for custom post type
**/
  
 function wcp_archive_template($archive_template) {
  $myposttype_template = trailingslashit( plugin_dir_path( __FILE__ )) . 'template/archive-pantone.php';
  return get_post_type() === 'pantone' && file_exists($myposttype_template) ? $myposttype_template : $archive_template;
}
add_filter('archive_template', 'wcp_archive_template');

 function wcp_single_template($single_template) {
  $myposttype_template = trailingslashit( plugin_dir_path( __FILE__ )) . 'template/single-pantone.php';
  return get_post_type() === 'pantone' && file_exists($myposttype_template) ? $myposttype_template : $single_template;
}
add_filter('single_template', 'wcp_single_template');

?>
