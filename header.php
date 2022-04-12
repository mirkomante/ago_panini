<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php bloginfo(); ?></title>
        <link href="<?php bloginfo( 'stylesheet_url' ); echo '?ver='.filemtime(get_stylesheet_directory().'/style.css'); ?>" rel="stylesheet">
    </head>
    <body>
    <div id="nav-wrap" class="w-full h-screen absolute top-0 left-0 -z-10 flex overflow-hidden">
    
    <div class="nav-half-sx flex w-1/2 h-full justify-items-center items-center bg-white top-full transition-[top] duration-[2s] ease-in-out">
      <div class="w-full h-2/5 border-r-2 border-solid border-black text-center pt-20">
        <?php 
              $rows = get_field('voci_menu', 'option');
              if( $rows ) {
                foreach( $rows as $row ) {
                  foreach( $row as $post ){
                    setup_postdata($post);
                    echo '<a href="'.get_the_permalink().'" class="menu-item inline-block leading-6"><span class="font-display text-5xl font-normal align-middle">'.get_the_title().'</span><img class="inline-block align-middle ml-5" src="'.get_template_directory_uri().'/assets/img/arrow.svg"></a>';
                  }
                  wp_reset_postdata();
                }
              }
         ?>
      </div>
    </div>

    <div class="nav-half-dx flex w-1/2 h-full justify-items-center items-center bg-white -top-full transition-[top] duration-[2s] ease-in-out">
      <div class="w-full h-2/5 pt-20 pl-40">
        <p class="font-display text-5xl font-normal uppercase mb-4"><?php the_field('titolo_blocco', 'option'); ?></p>
        <p class="font-display text-lg font-light ml-2"><a href="<?php the_field('google_maps_link', 'option'); ?>"><?php the_field('indirizzo_via', 'option'); ?></a></p>
        <p class="font-display text-lg font-light ml-2"><?php the_field('indirizzo_citta', 'option'); ?></p>
        <p class="font-display text-lg font-light ml-2"><a href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a></p>
        <p class="font-display text-lg font-light ml-2"><a href="tel:<?php the_field('telefono', 'option'); ?>"><?php the_field('telefono', 'option'); ?></a></p>
      </div>
    </div>
    </div>

  </div>
  <header class="flex flex-row h-[100px] z-30 items-center">
    <div class="shrink pt-3 pl-3">
      <a href="<?php echo home_url();?>"><span id="logo" class="font-display text-5xl font-extralight text-black">AGO_PANINI</span></a>
    </div>
    <div class="grow">
    </div>
    <div class="shrink overflow-hidden">
      <div id="menu-toggle" class="relative cursor-pointer w-[100px] h-[100px] float-right">
        <div id="hamburger" class="absolute w-full h-full">
          <span class="block rounded-sm relative bg-black w-[60px] h-1 top-6 left-5 my-[10px] mx-0 transition-all duration-200  ease-in-out"></span>
          <span class="block rounded-sm relative bg-black w-[40px] h-1 top-6 left-5 my-[10px] mx-0 transition-all duration-200  ease-in-out"></span>
          <span class="block rounded-sm relative bg-black w-[10px] h-1 top-6 left-5 my-[10px] mx-0 transition-all duration-200  ease-in-out"></span>
        </div>
        <div id="cross" class="absolute w-full h-full rotate-45">
          <span class="menu-line block rounded-sm absolute bg-black h-[0%] w-1 top-[10%] left-12 delay-0 transition-all duration-200  ease-in-out"></span>
          <span class="menu-line block rounded-sm absolute bg-black w-[0%] h-1 left-[10%] top-12 delay-200 transition-all duration-200  ease-in-out"></span>
        </div>
      </div>
    </div>
  </header>

    