var gulp = require('gulp');
var less = require('gulp-less');
var minifyCSS = require('gulp-csso');
var ts = require('gulp-typescript');
var merge = require('merge2');
var plumber = require('gulp-plumber');


gulp.task('watch', function() {
	gulp.watch('public/assets/less/**/*.less', ['css']);
	gulp.watch('public/assets/ts/**/*.ts', ['scripts']);
});

gulp.task('css', function(){
  return gulp.src('public/assets/less/app.less')
  	.pipe(plumber())
    .pipe(less())
    .pipe(minifyCSS())
    .pipe(gulp.dest('public/dist/css'))
});

gulp.task('scripts', function() {
    var tsResult = gulp.src('public/assets/ts/**/*.ts')
        .pipe(ts({
            declaration: true
        }));

    return merge([
        tsResult.dts.pipe(gulp.dest('public/dist/definitions')),
        tsResult.js.pipe(gulp.dest('public/dist/js'))
    ]);
});

gulp.task('default', ['css', 'scripts' ,'watch']);
