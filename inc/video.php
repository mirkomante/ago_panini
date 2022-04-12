<?php
/**
 * Registers the `video` post type.
 */
function video_init() {
	register_post_type( 'video', array(
		'labels'                => array(
			'name'                  => __( 'Video', 'ago_panini' ),
			'singular_name'         => __( 'Video', 'ago_panini' ),
			'all_items'             => __( 'Tutti', 'ago_panini' ),
			'archives'              => __( 'Video Archivio', 'ago_panini' ),
			'attributes'            => __( 'Video Attributi', 'ago_panini' ),
			'insert_into_item'      => __( 'Aggiungi', 'ago_panini' ),
			'uploaded_to_this_item' => __( 'Uploaded to this video', 'ago_panini' ),
			'featured_image'        => _x( 'Featured Image', 'video', 'ago_panini' ),
			'set_featured_image'    => _x( 'Set featured image', 'video', 'ago_panini' ),
			'remove_featured_image' => _x( 'Remove featured image', 'video', 'ago_panini' ),
			'use_featured_image'    => _x( 'Use as featured image', 'video', 'ago_panini' ),
			'filter_items_list'     => __( 'Filter video list', 'ago_panini' ),
			'items_list_navigation' => __( 'Video list navigation', 'ago_panini' ),
			'items_list'            => __( 'Video list', 'ago_panini' ),
			'new_item'              => __( 'Nuovo', 'ago_panini' ),
			'add_new'               => __( 'Aggiungi', 'ago_panini' ),
			'add_new_item'          => __( 'Aggiungi', 'ago_panini' ),
			'edit_item'             => __( 'Modifica', 'ago_panini' ),
			'view_item'             => __( 'Visualizza', 'ago_panini' ),
			'view_items'            => __( 'Visualizza', 'ago_panini' ),
			'search_items'          => __( 'Cerca video', 'ago_panini' ),
			'not_found'             => __( 'Nessun video trovato', 'ago_panini' ),
			'not_found_in_trash'    => __( 'Nessun video trovato', 'ago_panini' ),
			'parent_item_colon'     => __( 'Parent video:', 'ago_panini' ),
			'menu_name'             => __( 'Video', 'ago_panini' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'thumbnail' ),
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-buddicons-buddypress-logo',
		'show_in_rest'          => true,
		'rest_base'             => 'video',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'video_init' );

/**
 * Sets the post updated messages for the `video` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `video` post type.
 */
function video_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['video'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'video updated. <a target="_blank" href="%s">View video</a>', 'ago_panini' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'ago_panini' ),
		3  => __( 'Custom field deleted.', 'ago_panini' ),
		4  => __( 'video updated.', 'ago_panini' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'video restored to revision from %s', 'ago_panini' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'video published. <a href="%s">View video</a>', 'ago_panini' ), esc_url( $permalink ) ),
		7  => __( 'video saved.', 'ago_panini' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'video submitted. <a target="_blank" href="%s">Preview video</a>', 'ago_panini' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'video scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview video</a>', 'ago_panini' ),
		date_i18n( __( 'M j, Y @ G:i', 'ago_panini' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'video draft updated. <a target="_blank" href="%s">Preview video</a>', 'ago_panini' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'video_updated_messages' );


?>
