<div class="sidebar-con-left">
  <div class="sidebar-con-tit">
    <div class="sidebar-con-box"><font class="this">相关内容</font><span class="this">Relevant&nbsp;</span></div>
  </div>
  <div class="sidebar-con-left-nav">
    <ul>
      <?php
        $this_post = get_the_ID();
        $categories = wp_get_post_categories($this_post);
        $pages = new WP_Query(array(
          'posts_per_page' => 5,
          'category__in' => $categories
          ));
        $i = 0;
        while( $pages->have_posts()) {
          $pages->the_post();
          $i ++;
      ?>
        <li <?php if($i == 1){ echo 'id="onefirst"'; } ?> <?php if(get_the_ID() == $this_post){ echo 'class="navdown"'; }?>>
          <div>
            <strong <?php if(get_the_ID() == $this_post){ echo 'class="navdown"'; }?>>&nbsp;</strong>
            <a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a>
          </div>
        </li>
      <?php
        } wp_reset_postdata();
      ?>
    </ul>
    <div class="clear"></div>
  </div>
  <?php get_template_part('contact'); ?>
</div>
