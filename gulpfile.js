var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync').create();
    php = require ('gulp-connect-php'),
    uglify = require('gulp-uglify'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps  = require('gulp-sourcemaps'),
    concat = require('gulp-concat'),
    del = require('del'),
    rename = require('gulp-rename'),
    babel = require('gulp-babel'),
    compressimages = require('compress-images');
    imgSrc = 'app/img/**/*.{jpg,JPG,jpeg,JPEG,png,svg,gif}';
    imgBld = 'build/img/';

function handleError (error) {
    console.log(error.toString())
    this.emit('end')
};

// PRODUCTION
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

// DEPLOYMENT

// delete previous production build
gulp.task('prod:cleanfolder', function(){
    return del([
      'build/**/*'
    ]);
  });

  // compress images
gulp.task('prod:imgMin', ['prod:cleanfolder'], function(){

    compressimages(imgSrc, imgBld, {compress_force: false, statistic: true, autoupdate: true}, false,
        {jpg: {engine: 'mozjpeg', command: ['-quality', '60']}},
        {png: {engine: 'pngquant', command: ['--quality=20-50']}},
        {svg: {engine: 'svgo', command: '--multipass'}},
        {gif: {engine: 'gifsicle', command: ['--colors', '64', '--use-col=web']}}, function(){
    });
//     return gulp.src('./img/**/*')
//         .pipe(compressimages())
//         .pipe(gulp.dest('build/img'));
});

// minify css for build
gulp.task('prod:sass', ['prod:cleanfolder'], function() {
  gulp.src('app/scss/styles.scss')
  .pipe(sass({outputStyle: 'compressed'}))
  .pipe(gulp.dest('build/css/'));
});

// uglify and mangle js
gulp.task('prod:scripts', ['prod:sass'], function(){
    gulp.src([
              'app/js/**/*.js'
            ])
    .pipe(concat('scripts.js'))
    .pipe(uglify())
    .pipe(gulp.dest('build/js'));
  
    // gulp.src([
    //           'app/js/**/*/'
    //         ])
    // .pipe(gulp.dest('build/js'));
  });

  // copy development files not requiring processing
gulp.task('prod:copy', ['prod:imgMin'], function(){
    return gulp.src([
                    './app/**/*/',
                    '!./app/css/*/',
                    '!./app/img/*/',
                    '!./app/js/*/'
                  ])
    .pipe(gulp.dest('./build'));
  });

  // delete previous production build
gulp.task('prod:tidy', ['prod:copy'], function(){
    return del([
      'build/scss',
      'build/**/*{bu*,BU*}',
      'build/**/*jquery*'
    ]);
  });
  
  // main build task
  gulp.task('build', ['prod:cleanfolder', 'prod:imgMin', 'prod:sass', 'prod:scripts', 'prod:copy', 'prod:tidy']);
  