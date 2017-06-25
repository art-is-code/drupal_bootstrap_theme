var gulp = require('gulp'); 
const imagemin = require('gulp-imagemin');
var pump = require('pump');
var uglify = require('gulp-uglify');

// Include plugins
var plugins = require('gulp-load-plugins')(); // all plugins from package.json

// Paths variables
var source = './src'; // working directory
var destination = './dist'; // published directory

// "css" = sass + csscomb + cssbeautify + + csso (minification) + autoprefixer
gulp.task('css', function () {
  return gulp.src(source + '/assets/sass/styles.scss')
    .pipe(plugins.sass())
    .pipe(plugins.csscomb())
    .pipe(plugins.cssbeautify({indent: '  '}))
    .pipe(plugins.autoprefixer())
    .pipe(plugins.csso())
    .pipe(plugins.rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(destination + '/assets/css/'));
});

// "minify" = CSS minification
// gulp.task('minifyCSS', function () {
//   return gulp.src(destination + '/assets/css/*.css')
//     .pipe(plugins.csso())
//     .pipe(plugins.rename({
//       suffix: '.min'
//     }))
//     .pipe(gulp.dest(destination + '/assets/css/'));
// });

// "img" = Optimize images
gulp.task('img', function () {
  return gulp.src(source + '/assets/i/*.{png,jpg,jpeg,gif,svg}')
    .pipe(imagemin())
    .pipe(gulp.dest(destination + '/assets/i'));
});

// "copyfonts" = Fonts
gulp.task('copyfonts', function() {
  return gulp.src(source + '/assets/f/*.{ttf,woff,eot,svg}')
    .pipe(gulp.dest(destination + '/assets/f'));
});

// "copyjs" = JS
gulp.task('copyjs', function() {
return gulp.src(source + '/assets/j/*.js')
    .pipe(gulp.dest(destination + '/assets/j'));
});

// "render" = Build the result
gulp.task('render', ['css', 'copyjs', 'img', 'copyfonts']);

// "watch" = Watching *scss
gulp.task('watch', function () {
  gulp.watch(source + '/assets/sass/*.scss', ['render']);
});

// Default task
gulp.task('default', ['render', 'watch']);
