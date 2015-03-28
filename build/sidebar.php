<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package bbf
 */

?>

<div class="sidebar-con-left">
	<?php $cat = get_category(get_query_var('cat')); ?>
	<div class="sidebar-con-tit">
	    <div class="sidebar-con-box"><font class="this"><?php echo $cat->name; ?></font><span class="this"><?php echo ucwords($cat->slug); ?>&nbsp;</span></div>
	</div>
	<div class="sidebar-con-left-nav">
	    <ul>
	    	<?php
	    		$args = array(
	    			'child_of' => get_query_var('cat'),
	    			'hide_empty' => 0
	    			);
	    		$categories = get_categories($args);
	    		$i = 0;
	    		if (count($categories) > 0):
	    		foreach ($categories as $category) {
	    			$i ++;
	    	?>
	    	<li id="<?php if($i ==1): echo 'onefirst'; endif; ?>">
	    		<div>
					<strong class="navdown">&nbsp;</strong>
					<a href="/?cat=<?php echo $category->cat_ID; ?>" title=""><?php echo $category->name ?></a>
	    		</div>
	    	</li>
	    	<?php } else: ?>
	    	<p class="no-data">暂无相关内容</p>
	    <?php endif; ?>
	    </ul>
	 	<div class="clear"></div>
	</div>
  <?php get_template_part('contact'); ?>
</div>
