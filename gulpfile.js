var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
var php = require ('gulp-connect-php');

function handleError (error) {
    console.log(error.toString())
    this.emit('end')
};

gulp.task('php', function() {
    php.server({ base: 'app', port: 8010, keepalive: true});
});

gulp.task('browserSync',['php'], function() {
    browserSync.init({
        proxy: '127.0.0.1:8010',
        port: 8080,
        open: true,
        notify: false
    });
});

gulp.task('sass', function(){
    return gulp.src('app/scss/**/*.scss')
    .pipe(sass()) // Converts Sass to CSS with gulp-sass
    .on('error', handleError) //Show details on any errors
    .pipe(gulp.dest('app/css'))
    .pipe(browserSync.reload({
        stream: true
      }));
});

gulp.task('watch',['browserSync','sass'], function(){
    gulp.watch('app/scss/**/*.scss', ['sass']);
    gulp.watch('app/*.php', browserSync.reload); 
    gulp.watch('app/js/**/*.js', browserSync.reload);
});