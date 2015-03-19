/**
 * @denpendency
 */
var gulp = require('gulp');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var notify = require('gulp-notify');
var del = require('del');
var rsync = require('gulp-rsync');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var replace = require('gulp-replace');
var sass = require('gulp-sass');
var cssmin = require('gulp-minify-css');



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
    .pipe(gulp.dest(dir()))
    .pipe(reload({stream: true}));
});

gulp.task('script', function(){
  return gulp.src(['node_modules/jquery/dist/jquery.js', 'src/js/*.js'])
  .pipe(concat('bundle.js'))
  .pipe(gulp.dest(dir()));
});

gulp.task('copy-staff', function(){
  gulp.src('src/images/**/*')
  .pipe(gulp.dest(isWatch ? 'watch/images' : 'build/images'));

  gulp.src(['src/sass/PIE.htc'])
  .pipe(gulp.dest(dir()));
});

gulp.task('server', function(){
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

// gulp.task('deployStyle', ['style'], function(){
//   gulp.src(buildStyleDir + '/**/app.css')
//     .pipe(autoprefixer({
//       browsers: ['last 2 versions', 'ie 8', 'ie 9', 'ie 7', 'ie 6']
//     }))
//     .pipe(cssmin({
//       compatibility: 'ie8'
//     }))
//     .pipe(gulp.dest(buildStyleDir));
// });

gulp.task('clearnWatchDir', function(){
  del.sync(['watch']);
});

gulp.task('replace', function(){
  gulp.src('src/*.php')
  .pipe(replace('BBF_STYLE_DIR', 'http://bbf.com/wp-content/themes/bbf'))
  .pipe(gulp.dest(dir()));
});

function dir() {
  return isWatch ? 'watch' : 'build';
}

/*==========================================
可用任务
==========================================*/
gulp.task('watch', ['clearnWatchDir', 'setWatch', 'script', 'style', 'copy-staff', 'replace', 'server'], function(){
  gulp.watch('src/**/*.scss', ['style']);
  gulp.watch('src/**/*.php', function(){
    gulp.start(['copy-staff', 'replace', 'reload']);
  });
});

gulp.task('deploy', function(){
  console.log('\n deployment started at ' + new Date() + '\n');
  del.sync(['build']);
  process.env.NODE_ENV = 'production';
  gulp.start(['script', 'deployStyle']);
});

gulp.task('deployTest', function(){
  gulp.src(['src/**/*.html', 'watch/**/*.js', 'watch/**/*.css'])
    .pipe(rsync({
      hostname: 'test',
      destination: '/www/op-marketing.tbcdn.cn',
      exclude: ['node_modules/']
    }));
});
