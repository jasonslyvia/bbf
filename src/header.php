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
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title("_", true, 'right');?></title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="BBF_STYLE_DIR/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="BBF_STYLE_DIR/images/favicon.ico" type="image/x-icon">
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
			<a href='/wp-login.php'>企业邮箱登录</a> | <a href='/wp-login.php?action=register'>注册</a>
		</div>
  </div>

  <div class="header-con">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" id="web_logo">
      <img src="BBF_STYLE_DIR/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" />
    </a>

    <div class="nav-box">
      <ul>
        <li class="active"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="first">首页</a></li>
        <li>
          <a href="/about">公司简介</a>
          <ul>
            <li><a href="/about" class="first">公司简介</a></li>
            <li><a href="/certificate">资历证明</a></li>
          </ul>
        </li>
        <li class="product-item">
          <a href="/?cat=<?php echo get_cat_ID('产品'); ?>">产品展示</a>
          <ul>
            <li><a href="/?cat=<?php echo get_cat_ID('产品'); ?>" class="first">产品展示</a></li>
            <div class="product-menu">
              <div class="product-section first">
                <h4 class="title"><a href="/?cat=<?php echo get_cat_ID('数控系统'); ?>">数控系统</a></h4>
                <img src="BBF_STYLE_DIR/images/skxt.jpg" width="150" height="50">
                <div class="sub-link">
                  <a href="/?cat=<?php echo get_cat_ID('车床数控系统'); ?>">车床数控系统</a>
                  <a href="/?cat=<?php echo get_cat_ID('铣床数控系统'); ?>">铣床数控系统</a>
                </div>
              </div>
              <div class="product-section">
                <h4 class="title"><a href="/?cat=<?php echo get_cat_ID('伺服驱动系统'); ?>">伺服驱动系统</a></h4>
                <img src="BBF_STYLE_DIR/images/sfqd.jpg" width="150" height="50">
                <div class="sub-link">
                  <a href="/?cat=<?php echo get_cat_ID('单轴伺服驱动'); ?>">单轴伺服驱动</a>
                  <a href="/?cat=<?php echo get_cat_ID('双轴伺服驱动'); ?>">双轴伺服驱动</a>
                </div>
              </div>
              <div class="product-section">
                <h4 class="title"><a href="/?cat=<?php echo get_cat_ID('主轴驱动系统'); ?>">主轴驱动系统</a></h4>
                <img src="BBF_STYLE_DIR/images/zzqd.jpg" width="150" height="50">
                <div class="sub-link">
                  <a href="/?cat=<?php echo get_cat_ID('主轴驱动系统'); ?>">主轴驱动系统</a>
                </div>
              </div>
            </div>
          </ul>
        </li>
        <li>
          <a href="/service">服务中心</a>
          <ul>
            <li><a href="/service" class="first">服务中心</a></li>
            <li><a href="/sales">销售网络</a></li>
          </ul>
        </li>
        <li><a href="/contact" class="first">联系我们</a></li>
        <li><a href="/?cat=<?php echo get_cat_ID('资料下载'); ?>" class="first">资料下载</a></li>
      </ul>
    </div>
  </div>
</div>

<?php if(!is_home()) : ?>
<div class="sub-header"></div>
<?php endif ; ?>
