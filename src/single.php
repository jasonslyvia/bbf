<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package bbf
 */
get_header();
?>
<div class="sidebar-box">
  <div class="sidebar-con">
    <?php get_sidebar('post'); ?>

    <div class="sidebar-con-right">
    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="sidebar-con-tit">
        <p>当前位置： <a href="../" title="网站首页">网站首页</a> &gt; <a href=../news/ >装修知识</a> > <a href=../news/news_5_1.html >风水指南</a></p>
        <font class="this"><?php the_title(); ?></font>
      </div>
      <div class="sidebar-con-right-con">
        <div class="editor active" id="showtext">
          <?php the_content(); ?>
          <div class="clear"></div>
        </div>
      </div>
    <?php  endwhile; endif; ?>
    </div>
    <div class="clear"></div>
  </div>
</div>

<?php get_footer(); ?>
