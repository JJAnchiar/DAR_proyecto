<?php
/*
 * Template Name: Sobre Nosotros
 */

 if ( ! defined( 'ABSPATH' ) ) {
	die();
}

get_header();
?>

<main class="sobre-page container">
  
  <header class="sobre-header">
    <h1 class="sobre-title"><?php the_title(); ?></h1>
  </header>

  <section class="sobre-contenido grid-2cols">
    <div class="sobre-imagen">
      <?php 
      if ( has_post_thumbnail() ) {

        the_post_thumbnail( 'large', array( 'class' => 'imagen-destacada' ) );
      } else {
        echo '<img src="' . get_stylesheet_directory_uri() . '/assets/sobre_nosotros.avif" alt="Sobre nosotros" class="imagen-destacada">';
      }
      ?>
    </div>
    <div class="sobre-texto">
      <?php
      if ( function_exists('get_field') ) :
        $heading = get_field('sobre_heading');
        $texto   = get_field('sobre_texto');
        if ( $heading ) {
          echo '<h2 class="sobre-subtitulo">' . esc_html( $heading ) . '</h2>';
        }
        if ( $texto ) {
          echo wp_kses_post( wpautop( $texto ) );
        }
      else {
        while ( have_posts() ) : the_post();
          the_content();
        endwhile;}
      endif;
      ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>