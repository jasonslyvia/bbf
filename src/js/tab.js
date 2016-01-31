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
    if (tab == 0) {
      $title.text('联系电话');
      $('[data-tabtype="phone"]').addClass('tab-content-active');
      $('[data-tabtype="address"]').removeClass('tab-content-active');
    }
    else {
      $title.text('公司地址');
      $('[data-tabtype="phone"]').removeClass('tab-content-active');
      $('[data-tabtype="address"]').addClass('tab-content-active');
    }

    return false;
  });
});
