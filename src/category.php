<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package bff
 */
get_header(); ?>

<div class="banner-box">
  <img src="" />
</div>

<div class="sidebar-box">
  <div class="sidebar-con">
    <?php get_sidebar(); ?>
    
    <div class="sidebar-con-right">    
      <div class="sidebar-con-tit">
        <?php $cat = get_category(get_query_var('cat')); ?>
        <p>当前位置： <a href="../" title="网站首页">网站首页</a> &gt; <a href=../news/ >装修知识</a> > <a href=../news/news_5_1.html >风水指南</a></p>
        <font class="this"><?php echo $cat->name; ?></font><span class="this"><?php echo ucwords($cat->slug); ?>&nbsp;</span>
      </div>
      <div class="sidebar-con-right-con">        

        <div class="active" id="newslist">
			    <ul class='list-none metlist'>
            <?php
              $i = 0;
              while (have_posts()) {
                $i ++;
                the_post();
              ?>
            <li class='list <?php if ($i == 1): echo 'top'; endif; ?>'>
              <span><?php the_time('Y-m-d'); ?></span>
              <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' target='_self'><?php the_title(); ?></a>
              <p><?php echo mb_substr(get_the_content(), 0, 30).'..' ?></p>
            </li>
            <?php } ?>
          </ul>
  			  <div id="flip">
            <div class='digg4 metpager_8'>
              <?php echo paginate_links( array(
                'current' => max( 1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'prev_text' => __('« 上一页'),
                'next_text' => __('下一页 »'),
              ) ); ?>
            </div>
          </div>
		    </div>

      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>

<?php get_footer(); ?>