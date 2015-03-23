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
<link rel="stylesheet" type="text/css" href="/wp-content/themes/bbf/style.css" />
<script src="/wp-content/themes/bbf/bundle.js" type="text/javascript"></script>
<style>.nav-box ul li ul{behavior:url('/wp-content/themes/bbf/PIE.htc');}</style>

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
      <img src="http://fpoimg.com/218x79?text=Logo Placeholder" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" />
    </a>

    <div class="nav-box">
      <ul>
        <li class="active"><a href="#" class="first">首页</a></li>
        <li>
          <a href="#">公司简介</a>
          <ul>
            <li><a href="#" class="first">公司简介</a></li>
            <li><a href="#">关于我们</a></li>
            <li><a href="#">联系我们</a></li>
          </ul>
        </li>
        <li class="product-item">
          <a href="#">产品展示</a>
          <ul>
            <li><a href="#" class="first">产品展示</a></li>
            <div class="product-menu">
              <div class="product-section first">
                <h4 class="title">数控系统</h4>
                <img src="http://fpoimg.com/150x50?text=Category" width="150" height="50">
                <div class="sub-link">
                  <a href="#">车床数控系统</a>
                  <a href="#">铣床数控系统</a>
                </div>
              </div>
              <div class="product-section">
                <h4 class="title">伺服驱动器</h4>
                <img src="http://fpoimg.com/150x50?text=Category" width="150" height="50">
                <div class="sub-link">
                  <a href="#">单轴伺服驱动</a>
                  <a href="#">双轴伺服驱动</a>
                </div>
              </div>
              <div class="product-section">
                <h4 class="title">主轴驱动器</h4>
                <img src="http://fpoimg.com/150x50?text=Category" width="150" height="50">
                <div class="sub-link">
                  <a href="#">主轴驱动器</a>
                </div>
              </div>
            </div>
          </ul>
        </li>
        <li>
          <a href="#">服务中心</a>
          <ul>
            <li><a href="#" class="first">服务中心</a></li>
            <li><a href="#">销售网络</a></li>
          </ul>
        </li>
        <li><a href="#" class="first">联系我们</a></li>
        <li><a href="#" class="first">资料下载</a></li>
    </div>
  </div>
</div>
