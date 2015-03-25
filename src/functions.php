<?php
/**
 * bbf functions and definitions
 *
 * @package bbf
 */

error_reporting(E_ALL);

function catch_that_image($width, $height) {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  if (is_array($matches) && is_array($matches[1]) && isset($matches[1][0])) {
    $first_img = $matches [1] [0];
  }

  if(empty($first_img)){ //Defines a default image
    $first_img = "http://fpoimg.com/".$width."x".$height."?text=No Image";
  }
  return $first_img;
}

function remove_wp_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
}

add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );
