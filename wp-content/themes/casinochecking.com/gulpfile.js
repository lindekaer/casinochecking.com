var gulp = require('gulp'),
$ = require('gulp-load-plugins')(),
sourcemaps = require('gulp-sourcemaps'),
browserSync = require('browser-sync'),
jshint = require('gulp-jshint');;

var sassPaths = [
  'bower_components/normalize.scss/sass',
  'bower_components/foundation-sites/scss',
  'bower_components/motion-ui/src'
];

gulp.task('sass', function() {
  return gulp.src('scss/style.scss')
    .pipe(sourcemaps.init())
    .pipe($.sass({
      includePaths: sassPaths,
      outputStyle: 'compact',
      sourceMap: true
       // if css compressed **file size*
    })
    .on('error', $.sass.logError))
    .pipe($.autoprefixer({
      browsers: ['last 2 versions', 'ie >= 9']
    }))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('./'))
    .pipe(browserSync.stream());
});

gulp.task('css:reload', ['sass'], function() {
  browserSync.reload();
});

gulp.task('reloadbrowser', function(){ // for when php is loaded
  browserSync.reload();
}); 

// configure the jshint task
gulp.task('jshint', ['reloadbrowser'], function() {
  return gulp.src('js/**/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'));
});

gulp.task('watch', function() {
  browserSync.init({
        proxy: 'localhost/casinochecking.com/',
        
    });

  gulp.watch(['scss/**/*.scss'], ['css:reload']);
  gulp.watch("./*.php", ['reloadbrowser']);
  gulp.watch('js/**/*.js', ['jshint']);
});
gulp.task('default', ['watch']);
