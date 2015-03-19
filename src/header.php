<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package bbf
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="renderer" content="webkit">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link href="favicon.ico" rel="shortcut icon" />
<link rel="stylesheet" type="text/css" href="BBF_STYLE_DIR/style.css" />
<script src="BBF_STYLE_DIR/bundle.js" type="text/javascript"></script>
<style>.nav-box ul li ul{behavior:url('BBF_STYLE_DIR/PIE.htc');}</style>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="header-box">
  <div class="header-top">
    <div class="top-nav">
			<span class="i"></span>
			<a href='#' onclick='SetHome(this,window.location,"浏览器不支持此功能，请手动设置！");' style='cursor:pointer;' title='设为首页'  >设为首页</a> | <a href='#' onclick='addFavorite("浏览器不支持此功能，请手动设置！");' style='cursor:pointer;' title='收藏本站'  >收藏本站</a>
		</div>
  </div>

  <div class="header-con">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" id="web_logo">
      <img src="BBF_STYLE_DIR/upload/1418191427.png" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" />
    </a>

		<?php wp_nav_menu(array(
			'theme_location' => 'header-menu',
			'container' => 'div',
			'container_class' => 'nav-box'
		)); ?>

  </div>
</div>
