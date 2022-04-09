<?php
/**
* @package WordPress
* @subpackage Test
* @since 1.0
*/

show_admin_bar(false);

//add_action( 'cmb2_admin_init', 'cmb2_sample_metaboxes' );

//require_once ( 'inc/cmb.php' );

// admin_init action works better than admin_menu in modern wordpress (at least v5+)
add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {


  global $user_ID;

  if ( $user_ID != 1 ) { //your user id

   remove_menu_page('edit.php'); // Posts
   remove_menu_page('upload.php'); // Media
   remove_menu_page('link-manager.php'); // Links
   remove_menu_page('edit-comments.php'); // Comments
   remove_menu_page('edit.php?post_type=page'); // Pages
   remove_menu_page('plugins.php'); // Plugins
   remove_menu_page('themes.php'); // Appearance
   remove_menu_page('users.php'); // Users
   remove_menu_page('tools.php'); // Tools
   remove_menu_page('options-general.php'); // Settings

  }
}


?>
