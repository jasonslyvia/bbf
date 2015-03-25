<div class="sidebar-con-left">
  <div class="sidebar-con-tit">
    <div class="sidebar-con-box"><font class="this">相关页面</font><span class="this">Relevant&nbsp;</span></div>
  </div>
  <div class="sidebar-con-left-nav">
    <ul>
      <?php
        $pages = get_pages();
        $this_page = get_query_var('page_id');
        $i = 0;
        foreach  ($pages as $page) {
          $i ++;
      ?>
        <li <?php if($i == 1){ echo 'id="onefirst"'; } ?> <?php if($page->ID == $this_page){ echo 'class="navdown"'; }?>>
          <div>
            <strong <?php if($page->ID == $this_page){ echo 'class="navdown"'; }?>>&nbsp;</strong>
            <a href="<?php echo $page->guid; ?>" title="<?php echo $page->post_title;?>"><?php echo $page->post_title;?></a>
          </div>
        </li>
      <?php
        }
      ?>
    </ul>
    <div class="clear"></div>
  </div>
  <?php get_template_part('contact'); ?>
</div>
