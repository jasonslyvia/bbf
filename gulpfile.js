/**
 * @denpendency
 */
var gulp = require('gulp');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var notify = require('gulp-notify');
var del = require('del');
var scp = require('gulp-scp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var replace = require('gulp-replace');
var sass = require('gulp-sass');
var cssmin = require('gulp-minify-css');
var gif = require('gulp-if');



/**
 * @global
 */
var isWatch = false;
var htmlDir = './src/html/**/*.html';

/*==========================================
基础任务
==========================================*/
gulp.task('style', function(){
  return gulp.src('src/style.scss')
    .pipe(sass({
      sourcemap: true
    }))
    .on('error', function(){
      console.log(arguments);
      notify.onError().apply(null, arguments);
      this.emit('end');
    })
    .pipe(gif(!isWatch, cssmin({
      compatibility: 'ie7,-selectors.ie7Hack,-properties.iePrefixHack,-properties.ieSuffixHack'
    })))
    .pipe(gulp.dest(dir()))
    .pipe(reload({stream: true}));
});

gulp.task('script', function(){
  return gulp.src(['node_modules/jquery/dist/jquery.js', 'src/js/*.js'])
  .pipe(concat('bundle.js'))
  .pipe(gif(!isWatch, uglify()))
  .pipe(gulp.dest(dir()))
  .pipe(reload({stream: true}));
});

gulp.task('copy-staff', function(){
  gulp.src(['src/images/**/*', 'src/screenshot.png'])
  .pipe(gulp.dest(isWatch ? 'watch/images' : 'build/images'));

  gulp.src(['src/sass/PIE.htc'])
  .pipe(gulp.dest(dir()));
});

gulp.task('browserSync', function(){
  browserSync({
    proxy: 'bbf.com'
  });
});

gulp.task('reload', function(){
  browserSync.reload();
});

gulp.task('setWatch', function(){
  isWatch = true;
});

gulp.task('clearnWatchDir', function(){
  del.sync(['watch']);
});

gulp.task('replace', function(){
  gulp.src(['src/*.php', 'src/**/*.scss'])
  .pipe(replace('BBF_STYLE_DIR', '/wp-content/themes/bbf'))
  .pipe(gulp.dest(dir()));
});

function dir() {
  return isWatch ? 'watch' : 'build';
}

/*==========================================
可用任务
==========================================*/
gulp.task('watch', ['clearnWatchDir', 'setWatch', 'script', 'style', 'copy-staff', 'replace', 'browserSync'], function(){
  gulp.watch('src/**/*.scss', ['style']);
  gulp.watch('src/**/*.js', ['script']);
  gulp.watch('src/**/*.php', function(){
    gulp.start(['copy-staff', 'replace', 'reload']);
  });
});

gulp.task('deploy', function(){
  console.log('\n deployment started at ' + new Date() + '\n');
  del.sync(['build']);
  process.env.NODE_ENV = 'production';
  gulp.start(['script', 'style', 'copy-staff', 'replace']);
});

gulp.task('server', function(){
  gulp.src('build/**')
    .pipe(scp({
      host: 'aliyun',
      path: '/www/wordpress/wp-content/themes/bbf',
      port: 7260,
      exclude: ['node_modules/', 'sass/']
    }));
});
