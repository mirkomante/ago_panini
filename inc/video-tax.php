<?php 

add_action( 'init', 'create_video_tax', 0 );
 
function create_video_tax() {
 
    $labels = array(
        'name' => _x( 'Categorie', 'taxonomy general name' ),
        'singular_name' => _x( 'Categoria', 'taxonomy singular name' ),
        'search_items' =>  __( 'Cerca' ),
        'all_items' => __( 'Tutte' ),
        'parent_item' => __( 'Categoria padre' ),
        'parent_item_colon' => __( 'Categoria padre:' ),
        'edit_item' => __( 'Modifica Categoria' ), 
        'update_item' => __( 'Aggiorna Categoria' ),
        'add_new_item' => __( 'Aggiungi Categoria' ),
        'new_item_name' => __( 'Nuova Categoria' ),
        'menu_name' => __( 'Categorie' ),
      );    
     
 
  register_taxonomy('categorie','video',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'categoria' ),
  ));
}


?>