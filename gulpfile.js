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

// "minify" = minification CSS (destination -> destination)
gulp.task('minify', function () {
  return gulp.src(destination + '/assets/css/*.css')
    .pipe(plugins.csso())
    .pipe(plugins.rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(destination + '/assets/css/'));
});

/*Images*/

// "img" = Images optimisées
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
    .pipe(bootstrap_js.dest(destination + '/assets/j'))
    .pipe(gulp.dest(destination + '/assets/j'));
});

// Tâche "critical" = critical inline CSS
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

// "watch" = je surveille *scss
gulp.task('watch', function () {
  gulp.watch(source + '/assets/sass/*.scss', ['build']);
});

// Tâche par défaut
gulp.task('default', ['build', 'watch']);
