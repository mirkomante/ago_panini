<?php 

get_header();

$args	= array(	
				'post_type'			=>	'video',
				'posts_per_page'	=>	-1 
				);
$the_query = new WP_Query( $args ); 

?>

<div class="grid grid-cols-6 gap-2 max-w-screen-xl py-4 px-2 lg:px-32 my-4 lg:my-7 items-center justify-items-center border-y-2 border-gray-100 border-solid text-center mx-auto">
<?php 
		$rows = get_field('ordine_categorie_video', 'option');
		if( $rows ) {
			foreach( $rows as $row ) {
				echo ' <button class="filter font-display text-sm lg:text-2xl font-light hover:text-green-700 text-black uppercase" data-filter="'.$row["categoria_video"]->{'slug'}.'" >'.$row["categoria_video"]->{'name'}.'</button>';
			}
		}
?>
</div>

<div class="projects flex flex-wrap max-w-screen-xl my-4 lg:my-7 text-center mx-auto">

<?php if ( $the_query->have_posts() ): while ( $the_query->have_posts() ) : $the_query->the_post(); 

		$term_obj_list = get_the_terms( $post->ID, 'categorie' );
		
		$categorie	=	'';
		foreach ($term_obj_list as $key => $value) {
			$categorie	=	$categorie.$value->slug.' ';
		}
		$categorie	= trim($categorie);
		
		$image		=	get_field('cover_img');
		$video_url	=	get_field('vimeo_video_url');

		if($video_url){
			$video_vimeo = strstr($video_url, 'vimeo.');
			if($video_vimeo){
				$val = explode('/',$video_url);
				$videoID = end($val);
			}else{
				$video_vimeo = strstr($video_url, 'youtube.');
				$val = explode('/watch?v=',$video_url);
				$videoID = end($val);
			}
		}

		if( !empty( $image ) ){
			$copertina	=	esc_url($image['sizes']['thumbnail']);
		}else{
			$copertina	=	get_the_post_thumbnail_url($post->ID,'thumbnail');
		}


?>

	<div class="project <?php echo $categorie; ?> flex-initial w-1/2 p-2 relative overflow-hidden items-center justify-items-center" data-video="<?php echo $videoID;?>" data-filter="<?php echo $categorie; ?>">
      <img class="object-cover" src="<?php echo $copertina;?>">
      <div class="w-full h-full top-0 left-0 absolute">
        <div class="w-full h-full relative overflow-hidden flex flex-row items-center">
          <p class="w-full px-12 font-display text-xl lg:text-3xl lg:leading-tight text-center font-bold uppercase title-outline angle"><?php the_title(); ?></p>
        </div>
      </div>
    </div>

	<?php endwhile;wp_reset_postdata();
	else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
</div>

<div id="modal-wrap" class="w-full h-screen fixed top-0 left-0 -z-10 overflow-hidden">
    <div class="modal-scrim absolute h-screen w-full bottom-[-100vh] bg-black/90 transition-all duration-[1s] ease-out">
      <div class="modal fixed top-[-100vh] left-[7%] lg:left-[20%] h-[80vh] w-[85%] lg:w-[65%] my-0 mx-auto transition-top duration-[1s] ease-in-out">
        <div class="modal-content flex flex-col items-center justify-center h-full z-40">
          <p class="font-display text-xl text-white text-center mb-6 cursor-pointer">CLOSE X</p>
          <div id="video_player"></div>
        </div>
      </div>
    </div>
</div>

<?php get_footer();?>
