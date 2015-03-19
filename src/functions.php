<?php
/**
 * bbf functions and definitions
 *
 * @package bbf
 */
function register_my_menu() {
  register_nav_menu('header-menu', '导航菜单');
}
add_action( 'init', 'register_my_menu' );

