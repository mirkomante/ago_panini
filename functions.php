<?php
/**
* @package WordPress
* @subpackage Test
* @since 1.0
*/

show_admin_bar(false);
add_theme_support( 'post-thumbnails' );

require_once ( 'inc/video.php' );
require_once ( 'inc/video-tax.php' );

// admin_init action works better than admin_menu in modern wordpress (at least v5+)
add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {


  global $user_ID;
  
  if ( $user_ID != 11 ) { //your user id

  remove_menu_page('edit.php'); // Posts
  //  remove_menu_page('upload.php'); // Media
  //  remove_menu_page('link-manager.php'); // Links
    remove_menu_page('edit-comments.php'); // Comments
  //  remove_menu_page('edit.php?post_type=page'); // Pages
  //  remove_menu_page('plugins.php'); // Plugins
  //  remove_menu_page('themes.php'); // Appearance
  //  remove_menu_page('users.php'); // Users
  //  remove_menu_page('tools.php'); // Tools
  //  remove_menu_page('options-general.php'); // Settings

  }
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Impostazioni sito',
		'menu_title'	=> 'Impostazioni sito',
		'menu_slug' 	=> 'sito-dati',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Menu sito',
		'menu_title'	=> 'Menu',
		'parent_slug'	=> 'sito-dati',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Contatti',
		'menu_title'	=> 'Contatti',
		'parent_slug'	=> 'sito-dati',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Video home page',
		'menu_title'	=> 'Video',
		'parent_slug'	=> 'sito-dati',
	));
	
}


?>
