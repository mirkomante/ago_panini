<?php get_header();?>
<div class="absolute top-0 left-0 w-[100vw] h-[100vh] flex items-center marquee overflow-hidden">  
    <h1 class="font-display text-black text-9xl text-center font-bold title-outline whitespace-nowrap angle">
        <span class="inline-block pr-[10vw]">NIKE RUNNING - WE FLY </span>
        <span class="inline-block pr-[10vw]">LOREM IPSUM</span>
    	<span class="inline-block pr-[10vw]">BARILLA PISELLI</span> 
		<span class="inline-block pr-[10vw]">FERRARI GT4 LUSSO</span>
	</h1>
</div>
<div class="absolute top-0 left-0 w-full h-full -z-10 overflow-hidden bg-center bg-cover bg-no-repeat" style="background-image: url('assets/img/1.jpg')">
<?php 
	
	$rows = get_field('video_copertina', 'option');
	
	if( $rows ) {
    	foreach( $rows as $row ) {
        	foreach( $row as $post ){
				
				setup_postdata($post);
				$image		=	get_field('cover_img');
				$video_url	=	get_field('vimeo_video_url');
				
				if($video_url){
					$video_vimeo = strstr($video_url, 'vimeo.');
					if($video_vimeo){
						$val = explode('/',$video_url);
						$videoID = end($val);
					}
				}
				
				if( !empty( $image ) ){
					$copertina	=	esc_url($image['sizes']['thumbnail']);
				}else{
					$copertina	=	get_the_post_thumbnail_url($post->ID,'thumbnail');
				}
				echo $videoID;
				echo $copertina;
			}
            
			wp_reset_postdata();
        }
    }
?>

	<iframe class="absolute top-2/4 left-2/4 w-[100vw] h-[56.25vw] min-h-[100vh] min-w-[177.77vh] -translate-x-1/2 -translate-y-1/2" src="https://player.vimeo.com/video/362099857?background=1&autoplay=1&loop=1&byline=0&title=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

</div>

<?php get_footer();?>
