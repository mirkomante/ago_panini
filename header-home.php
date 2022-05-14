<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php bloginfo(); ?></title>
        <link href="<?php bloginfo( 'stylesheet_url' ); echo '?ver='.filemtime(get_stylesheet_directory().'/style.css'); ?>" rel="stylesheet">
    </head>
    <body class="home min-h-screen overflow-hidden bg-black">
      
      <div id="nav-wrap" class="w-full h-screen absolute top-0 left-0 -z-10 lg:flex overflow-hidden">
        <div class="nav-half-sx flex w-full h-1/2 lg:w-1/2 lg:h-full justify-items-center items-center bg-white top-full transition-[top] duration-[2s] ease-in-out">
          <div class="w-full h-2/5 lg:border-r-2 border-solid border-black text-center pt-20">
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
            <div class="w-14 h-0.5 bg-black mt-12 mx-auto lg:hidden"></div>
          </div>
        </div>
        <div class="nav-half-dx flex w-full h-1/2 lg:w-1/2 lg:h-full lg:justify-items-center lg:items-center bg-white -top-full transition-[top] duration-[2s] ease-in-out">
          <div class="w-full lg:h-2/5 lg:pt-20 lg:pl-40 text-center lg:text-left">
            <p class="font-display text-5xl font-normal uppercase mb-4"><?php the_field('titolo_blocco', 'option'); ?></p>
            <p class="font-display text-lg font-light ml-2"><a href="<?php the_field('google_maps_link', 'option'); ?>"><?php the_field('indirizzo_via', 'option'); ?></a></p>
            <p class="font-display text-lg font-light ml-2"><?php the_field('indirizzo_citta', 'option'); ?></p>
            <p class="font-display text-lg font-light ml-2"><a href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a></p>
            <p class="font-display text-lg font-light ml-2"><a href="tel:<?php the_field('telefono', 'option'); ?>"><?php the_field('telefono', 'option'); ?></a></p>
          </div>
        </div>

      </div>

      <header class="flex flex-row h-[70px] lg:h-[100px] z-30 items-center">
        <div class="shrink pt-3 pl-3">
          <a href="<?php echo home_url();?>"><span id="logo" class="font-display text-3xl lg:text-5xl font-extralight text-white">AGO_PANINI</span></a>
        </div>
        <div class="grow">
        </div>
        <div class="shrink overflow-hidden">
          <div id="menu-toggle" class="relative cursor-pointer w-[60px] h-[60px] lg:w-[100px] lg:h-[100px] float-right">
            <div id="hamburger" class="absolute w-full h-full">
              <span class="block rounded-sm relative bg-white w-[45px] lg:w-[60px] h-1 top-3 lg:top-6 left-2 lg:left-5 my-[8px] lg:my-[10px] mx-0 transition-all duration-200  ease-in-out"></span>
              <span class="block rounded-sm relative bg-white w-[30px] lg:w-[40px] h-1 top-3 lg:top-6 left-2 lg:left-5 my-[8px] lg:my-[10px] mx-0 transition-all duration-200  ease-in-out"></span>
              <span class="block rounded-sm relative bg-white w-[10px] lg:w-[10px] h-1 top-3 lg:top-6 left-2 lg:left-5 my-[8px] lg:my-[10px] mx-0 transition-all duration-200  ease-in-out"></span>
            </div>
            <div id="cross" class="absolute w-full h-full rotate-45">
              <span class="menu-line block rounded-sm absolute bg-black h-[0%] w-1 top-[9%] left-7 lg:top-[10%] lg:left-12 delay-0 transition-all duration-200  ease-in-out"></span>
              <span class="menu-line block rounded-sm absolute bg-black w-[0%] h-1 left-[9%] top-7 lg:left-[10%] lg:top-12 delay-200 transition-all duration-200  ease-in-out"></span>
            </div>
          </div>
        </div>
      </header>

    