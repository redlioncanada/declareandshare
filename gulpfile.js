// Gulp configuration

var gulp        = require('gulp');
var uglify      = require('gulp-uglify');
var browserSync = require('browser-sync');
var reload      = browserSync.reload;
var sass        = require('gulp-sass');


var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');

// Static server
gulp.task('browser-sync', function() {
    browserSync({
        server: {
            baseDir: "build"
        }
    });
});

// Gulp Sass task, will run when any SCSS files change & BrowserSync
// will auto-update browsers
gulp.task('sass', function () {
    return gulp.src('scss/**/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('build/css'))
        .pipe(reload({stream:true}));
});

// Gulp Ruby Sass
// https://github.com/sindresorhus/gulp-ruby-sass
// gulp.task('sass', function () {
//     return gulp.src('scss/*.scss')
//         // .pipe(sass({sourcemap: true, sourcemapPath: 'scss'}))
//         .on('error', function (err) { console.log(err.message); })
//         .pipe(gulp.dest('build/css'))
//         .pipe(reload({stream:true}));
// });


// process JS files and return the stream.
gulp.task('js', function () {
    return gulp.src('src/*.js')
        // .pipe(uglify())
        .pipe(gulp.dest('build/src'));
});



// Views task
gulp.task('views', function() {
    // Get our index.html
    gulp.src('index.html')
    // And put it in the build folder
    .pipe(gulp.dest('build/'));

    // Any other view files from app/views
    gulp.src('views/**/*')
    // Will be put in the build/views folder
    .pipe(gulp.dest('build/views/'));
});


// Images
gulp.task('images', function() {
    gulp.src('img/*/*')
    .pipe(gulp.dest('build/img/'));

  return gulp.src('img/*')
    .pipe(gulp.dest('build/img/'));
    // .pipe(notify({ message: 'Images task complete' }));
});

// use default task to launch BrowserSync and watch JS files
gulp.task('default', ['sass', 'js', 'images', 'browser-sync', 'views'], function () {
	
    // add browserSync.reload to the tasks array to make
    // all browsers reload after tasks are complete.

    gulp.watch('scss/**/*.scss', ['sass', browserSync.reload]);
    gulp.watch('views/**/*.html', ['views', browserSync.reload]);
    gulp.watch('src/*.js', ['src', browserSync.reload]);

});











