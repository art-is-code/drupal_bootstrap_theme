// Requis
var gulp = require('gulp'); 
const imagemin = require('gulp-imagemin');

// Include plugins
var plugins = require('gulp-load-plugins')(); // tous les plugins de package.json

// Variables de chemins
var source = './src'; // dossier de travail
var destination = './dist'; // dossier à livrer
var bootstrap_js = './bootstrap/assets/javascripts/bootstrap.min.js'

/*CSS*/

// "css" = sass + csscomb + cssbeautify + autoprefixer
gulp.task('css', function () {
  return gulp.src(source + '/assets/sass/styles.scss')
    .pipe(plugins.sass())
    .pipe(plugins.csscomb())
    .pipe(plugins.cssbeautify({indent: '  '}))
    .pipe(plugins.autoprefixer())
    .pipe(gulp.dest(destination + '/assets/css/'));
});

// "minify" = CSS minification
gulp.task('minify', function () {
  return gulp.src(destination + '/assets/css/*.css')
    .pipe(plugins.csso())
    .pipe(plugins.rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(destination + '/assets/css/'));
});

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

// "critical" = critical inline CSS
// gulp.task('critical', function() {
//   return  gulp.src('/*.php')
//     .pipe(critical({
//       base: destination,
//       inline: true,
//       width: 320,
//       height: 480,
//       minify: true
//     }))
//     .pipe(gulp.dest(destination));
// });

// "build"
gulp.task('build', ['css', 'img', 'copyfonts', 'copyjs']);

// "prod" = Build + minify
gulp.task('prod', ['css', 'img', 'copyfonts', 'copyjs', 'minify']);

// "watch" = Watching *scss
gulp.task('watch', function () {
  gulp.watch(source + '/assets/sass/*.scss', ['prod']);
});

// Default task
gulp.task('default', ['prod', 'watch']);
