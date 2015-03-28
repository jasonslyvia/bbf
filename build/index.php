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

<div class="banner-box" style="height:400px">
  <div class="banmove">
    <?php
    $query = new WP_Query(array(
      'category_name' => 'banner',
      'posts_per_page' => 3
    ));
    while ($query->have_posts()) {
      $query->the_post();
    ?>
    <a href="javascript:;" style="background-image: url(<?php echo preg_replace('/^.*?img.*?src=[\'\"](.*?)[\'\"].*?$/', '$1', get_the_content()); ?>);"></a>
    <?php }
    wp_reset_postdata();
    ?>
  </div>
  <div class="banmun"></div>
  <div class="banerbot"></div>
</div>

<div class="main-box">
  <div class="main-topblock"></div>
  <div class="main-con not-marginleft">
    <div class="main-con-top">
      <div class="main-con-bot">
        <div class="main-con-box">
          <?php $cat = get_category(get_cat_ID('企业新闻')); ?>
          <div class="main-con-img" style="background-image:url(<?php echo $cat->description; ?>);"></div>
          <div class="main-con-txt">
          <a href="<?php echo esc_url(get_category_link($cat->cat_ID)); ?>" class="title">
            <h3><?php echo $cat->name;?></h3><span>/</span><font><?php echo ucwords($cat->slug); ?></font></a>
              <?php
              $query = new WP_Query(array(
                'category_name' => $cat->slug,
                'posts_per_page' => 2
              ));
              while ($query->have_posts()) {
                $query->the_post();
              ?>
              <a href="<?php the_permalink(); ?>" class="once" title="<?php the_title();?>" target="_blank"><?php the_title();?></a>
              <?php } wp_reset_postdata(); ?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="main-con">
    <div class="main-con-top">
      <div class="main-con-bot">
        <div class="main-con-box">
          <?php $cat = get_category(get_cat_ID('行业动态')); ?>
          <div class="main-con-img" style="background-image:url(<?php echo $cat->description; ?>);"></div>
          <div class="main-con-txt">
          <a href="<?php echo esc_url(get_category_link($cat->cat_ID)); ?>" class="title">
            <h3><?php echo $cat->name;?></h3><span>/</span><font><?php echo ucwords($cat->slug); ?></font></a>
              <?php
              $query = new WP_Query(array(
                'category_name' => $cat->slug,
                'posts_per_page' => 2
              ));
              while ($query->have_posts()) {
                $query->the_post();
              ?>
              <a href="<?php the_permalink(); ?>" class="once" title="<?php the_title();?>" target="_blank"><?php the_title();?></a>
              <?php } wp_reset_postdata(); ?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>


  <div class="main-con" id="contact">
    <div class="main-con-top">
      <h3 class="title">联系电话</h3>
      <div class="tab">
        <div class="tab-head">
          <a href="#" class="tab-head"><i class="icon-phone-active" data-tab="0"></i></a>
          <a href="#" class="tab-head"><i class="icon-address" data-tab="1"></i></a>
          <div class="clear"></div>
        </div>
      </div>
      <div class="tab-content">
        <span class="telephone">+86 010 63714176</span>
      </div>
    </div>
  </div>

  <div class="clear"></div>
  <div class="main-pro">
    <div class="main-pro-top">
      <div class="main-pro-tit">
        <a href="/?cat=<?php echo get_cat_ID('产品') ?>" class="more-pro">更多 <font>>></font></a>
        <a href="/?cat=<?php echo get_cat_ID('产品') ?>" class="title">精品展示<font> / </font><span>Best Product</span></a>
      </div>
      <div class="main-pro-con" style="height:160px;">
        <div class="pro-left"></div>
        <div class="pro-center">
          <div class="pro-move" display="0">
            <?php
              $query = new WP_Query(array(
                'category_name' => 'product',
                'posts_per_page' => 10
              ));

              while ($query->have_posts()) {
                $query->the_post();
              ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="_blank">
                <img src="<?php echo catch_that_image(210, 160); ?>" width="210" height="160" title="<?php the_title();?>" alt="<?php the_title();?>" />
                <h3><?php the_title();?></h3>
              </a>
              <?php } wp_reset_postdata(); ?>

          </div>
          <div class="clear"></div>
        </div>
        <div class="pro-right" onselectstart="return false;"></div>
        <div class="clear"></div>
      </div>
      <div class="main-pro-tit link-xian">
        <a href="" class="title">友情链接 <span>LINKS ▼</span></a>
      </div>
      <div class="main-link">
        <ul class="main-link-txt">
          <li><a href="http://www.baidu.com" title="" target="_blank">百度</a></li>
          <li>|</li>
          <li><a href="www.google.cn" title="" target="_blank">谷歌</a></li>
				</ul>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
