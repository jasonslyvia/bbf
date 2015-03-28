<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package bbf
 */
?>

<?php if (is_home()): ?>
<div class="main-greet"></div>
<?php endif; ?>

<div class="footer-box">
  <div class="foot-nav">
    <a href='/about'  title='公司简介'>公司简介</a>
    <span>|</span>
    <a href='/contact'  title='联系我们'>联系我们</a>
    <span>|</span>
    <a href='/sitemap'  title='网站地图'>网站地图</a>
  </div>
  <p>&copy; 版权所有 2008-2014 京ICP备07008547号-1</p>
</div>
<?php wp_footer(); ?>

</body>
</html>



