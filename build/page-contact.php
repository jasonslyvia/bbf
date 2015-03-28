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
<style type="text/css">
    .my-map { margin: 0 auto; width: 100%; height: 300px; }
    .my-map .icon { background: url(http://lbs.amap.com/console/public/show/marker.png) no-repeat; }
    .my-map .icon-cir { height: 31px; width: 28px; }
    .my-map .icon-cir-red { background-position: -11px -5px; }
</style>
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
          <div id="mapContainer" class="my-map"></div>
          <?php the_content(); ?>
          <div class="clear"></div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <div class="clear"></div>
  </div>
</div>
  <script src="http://webapi.amap.com/maps?v=1.2&key=116b7bd3dd10c59dd54ef4d7c71e0d1b"></script>
  <script>
  !function(){
    var infoWindow, map, level = 16,
      center = {lng: 116.786417, lat: 39.617978},
      features = [{type: "Marker", name: "北京金保孚电气传动技术有限公司", desc: "北京市通州区永乐经济开发区恒业8街2号（永乐产业园28号厂房）", color: "red", icon: "cir", offset: {x: -9, y: -31}, lnglat: {lng: 116.786406, lat: 39.617987}}];

    function loadFeatures(){
      for(var feature, data, i = 0, len = features.length, j, jl, path; i < len; i++){
        data = features[i];
        switch(data.type){
          case "Marker":
            feature = new AMap.Marker({ map: map, position: new AMap.LngLat(data.lnglat.lng, data.lnglat.lat),
              zIndex: 3, extData: data, offset: new AMap.Pixel(data.offset.x, data.offset.y), title: data.name,
              content: '<div class="icon icon-' + data.icon + ' icon-'+ data.icon +'-' + data.color +'"></div>' });
            break;
          case "Polyline":
            for(j = 0, jl = data.lnglat.length, path = []; j < jl; j++){
              path.push(new AMap.LngLat(data.lnglat[j].lng, data.lnglat[j].lat));
            }
            feature = new AMap.Polyline({ map: map, path: path, extData: data, zIndex: 2,
              strokeWeight: data.strokeWeight, strokeColor: data.strokeColor, strokeOpacity: data.strokeOpacity });
            break;
          case "Polygon":
            for(j = 0, jl = data.lnglat.length, path = []; j < jl; j++){
              path.push(new AMap.LngLat(data.lnglat[j].lng, data.lnglat[j].lat));
            }
            feature = new AMap.Polygon({ map: map, path: path, extData: data, zIndex: 1,
              strokeWeight: data.strokeWeight, strokeColor: data.strokeColor, strokeOpacity: data.strokeOpacity,
              fillColor: data.fillColor, fillOpacity: data.fillOpacity });
            break;
          default: feature = null;
        }
        if(feature){ AMap.event.addListener(feature, "click", mapFeatureClick); }
      }
    }

    function mapFeatureClick(e){
      if(!infoWindow){ infoWindow = new AMap.InfoWindow({autoMove: true}); }
      var extData = e.target.getExtData();
      infoWindow.setContent("<h5>" + extData.name + "</h5><div>" + extData.desc + "</div>");
      infoWindow.open(map, e.lnglat);
    }

    map = new AMap.Map("mapContainer", {center: new AMap.LngLat(center.lng, center.lat), level: level, scrollWheel: false});

    loadFeatures();
    map.plugin(["AMap.ToolBar", "AMap.OverView", "AMap.Scale"], function(){
      map.addControl(new AMap.ToolBar);
      map.addControl(new AMap.OverView({isOpen: true}));
      map.addControl(new AMap.Scale);
    });
  }();
  </script>

<?php get_footer(); ?>
