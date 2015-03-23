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
