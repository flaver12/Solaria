var gulp = require('gulp');
var less = require('gulp-less');
var minifyCSS = require('gulp-csso');


gulp.task('watch', function() {
	gulp.watch('public/assets/less/**/*.less', ['css']);
});

gulp.task('css', function(){
  return gulp.src('public/assets/less/app.less')
    .pipe(less())
    .pipe(minifyCSS())
    .pipe(gulp.dest('public/dist/css'))
});

gulp.task('default', ['css' ,'watch']);
