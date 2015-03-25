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
    <?php get_sidebar('page'); ?>

    <div class="sidebar-con-right">
			<?php while ( have_posts() ) : the_post(); ?>
      <div class="sidebar-con-tit">
        <?php $cat = get_category(get_query_var('cat')); ?>
        <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
        <font class="this"><?php the_title(); ?></font>
      </div>
      <div class="sidebar-con-right-con">
      	<div class="editor active" id="showtext">
		    	<?php the_content(); ?>
					<div class="clear"></div>
				</div>
      </div>
		  <?php endwhile; ?>
    </div>
    <div class="clear"></div>
  </div>
</div>

<?php get_footer(); ?>
