<?php
/**
 * bbf functions and definitions
 *
 * @package bbf
 */
error_reporting(E_ALL);

function catch_that_image($width, $height) {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  if (is_array($matches) && is_array($matches[1]) && isset($matches[1][0])) {
    $first_img = $matches [1] [0];
  }

  if(empty($first_img)){ //Defines a default image
    $first_img = "http://fpoimg.com/".$width."x".$height."?text=No Image";
  }
  return $first_img;
}

function bbf_substr($str, $start = 0, $end = 0) {
  if (count($str) < $end - $start) {
    return $str;
  }
  else {
    return mb_substr($str, $start, $end).'...';
  }
}

/*****************************************\
        处理各种action及filter
\*****************************************/
//自定义title
add_action('wp_title', 'rw_title', 10, 3);
function rw_title($title, $sep, $direction){
    global $page, $paged;
    if ($direction == 'right') {
        $title .= get_bloginfo('name');
    }
    else{
        $title = get_bloginfo('name').$title;
    }
    $desc = get_bloginfo('description', 'display');
    if ($desc && (is_home() || is_front_page())) {
        $title .= "{$sep}{$desc}";
    }
    if ($paged >=2 || $page >= 2) {
        $title .= "{$sep}"."第".max($page, $paged)."页";
    }
    return $title;
}

add_action( 'after_setup_theme', 'custom_theme_setup' );
function custom_theme_setup() {
  add_theme_support('post-thumbnails', array( 'post' ));
  add_image_size( 'gallery', 210, 160, true);
  add_image_size( 'thumb-list', 64, 64 );
}

function autoset_featured() {
    global $post;
    $already_has_thumb = has_post_thumbnail($post->ID);

    if (!$already_has_thumb)  {
      $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
      if ($attached_image) {
        foreach ($attached_image as $attachment_id => $attachment) {
          set_post_thumbnail($post->ID, $attachment_id);
        }
      }
    }
}
add_action('the_post', 'autoset_featured');
add_action('save_post', 'autoset_featured');
add_action('draft_to_publish', 'autoset_featured');
add_action('new_to_publish', 'autoset_featured');
add_action('pending_to_publish', 'autoset_featured');
add_action('future_to_publish', 'autoset_featured');

add_filter('show_admin_bar', '__return_false');


//隐藏部分后台设置选项
function remove_menus(){
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'themes.php');                 //Appearance
  remove_menu_page( 'plugins.php' );                //Plugins
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'edit-comments.php' );          //Comments
}
add_action( 'admin_menu', 'remove_menus' );

function remove_wp_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
}
add_action('wp_enqueue_scripts', 'remove_wp_open_sans');

function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );


function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
            background-size: auto;
            width: auto;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function custom_colors() { ?>
  <style type="text/css">
      #wp-admin-bar-wp-logo {display: none;}
      #wpfooter {visibility: hidden;}
  </style>
<?php }

add_action('admin_head', 'custom_colors');

add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page() {
  add_menu_page( '管理轮播图', '轮播图', 'manage_options', 'edit.php?category_name=banner', '', '', 6 );
}

//面包屑导航
function dimox_breadcrumbs() {
  /* === OPTIONS === */
  $text['home']     = '主页'; // text for the 'Home' link
  $text['category'] = '%s'; // text for a category page
  $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
  $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
  $text['author']   = 'Articles Posted by %s'; // text for an author page
  $text['404']      = 'Error 404'; // text for the 404 page

  $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
  $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
  $show_title     = 1; // 1 - show the title for the links, 0 - don't show
  $delimiter      = ' &gt; '; // delimiter between crumbs
  $before         = '<span class="current">'; // tag before the current crumb
  $after          = '</span>'; // tag after the current crumb
  /* === END OF OPTIONS === */

  global $post;
  if ($post == null) {
    return null;
  }

  $home_link    = home_url('/');
  $link_before  = '<span typeof="v:Breadcrumb">';
  $link_after   = '</span>';
  $link_attr    = ' rel="v:url" property="v:title"';
  $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
  $parent_id    = $parent_id_2 = $post->post_parent;
  $frontpage_id = get_option('page_on_front');

  if (is_home() || is_front_page()) {

    if ($show_on_home == 1) echo '<p class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></p>';

  } else {

    echo '<p class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">当前位置：';
    if ($show_home_link == 1) {
      echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
      if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
    }

    if ( is_category() ) {
      $this_cat = get_category(get_query_var('cat'), false);
      if ($this_cat->parent != 0) {
        $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
        if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
        $cats = str_replace('</a>', '</a>' . $link_after, $cats);
        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
        echo $cats;
      }
      if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

    } elseif ( is_search() ) {
      echo $before . sprintf($text['search'], get_search_query()) . $after;

    } elseif ( is_day() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        printf($link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($show_current == 1) echo $delimiter . $before . '正文' . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $delimiter);
        if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
        $cats = str_replace('</a>', '</a>' . $link_after, $cats);
        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
        echo $cats;
        if ($show_current == 1) echo $before . '正文' . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($parent_id);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      if ($cat) {
        $cats = get_category_parents($cat, TRUE, $delimiter);
        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
        $cats = str_replace('</a>', '</a>' . $link_after, $cats);
        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
        echo $cats;
      }
      printf($link, get_permalink($parent), $parent->post_title);
      if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

    } elseif ( is_page() && !$parent_id ) {
      if ($show_current == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $parent_id ) {
      if ($parent_id != $frontpage_id) {
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          if ($parent_id != $frontpage_id) {
            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
          }
          $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs)-1) echo $delimiter;
        }
      }
      if ($show_current == 1) {
        if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
        echo $before . get_the_title() . $after;
      }

    } elseif ( is_tag() ) {
      echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . sprintf($text['author'], $userdata->display_name) . $after;

    } elseif ( is_404() ) {
      echo $before . $text['404'] . $after;

    } elseif ( has_post_format() && !is_singular() ) {
      echo get_post_format_string( get_post_format() );
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('第') . get_query_var('paged').('页');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</p><!-- .breadcrumbs -->';

  }
}
