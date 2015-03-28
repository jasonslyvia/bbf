$(function(){
  $('.tab-head a i').on('click', function(){
    var $tab = $(this);
    var className = $tab.attr('class');
    if (className.match(/-active$/)) {
      return false;
    }

    var $prev = $tab.closest('.tab').find('[class$="active"]');
    var prevClass = $prev.attr('class');
    $prev.removeClass(prevClass).addClass(prevClass.replace(/-active/, ''));

    $tab.removeClass(className).addClass(className + '-active');

    var tab = $tab.data('tab');
    var $title = $tab.closest('.main-con').find('.title');
    var $content = $tab.closest('.main-con').find('.tab-content');
    if (tab == 0) {
      $title.text('联系电话');
      $content.empty().append('<span class="telephone">+86 010 63714176</span>');
    }
    else {
      $title.text('公司地址');
      $content.empty().append('<span class="address">北京市通州区永乐经济开发区恒业8街2号（永乐产业园28号厂房）</span>');
    }

    return false;
  });
});
