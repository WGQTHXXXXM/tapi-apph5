var gulp = require('gulp');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var prefixer = require('gulp-autoprefixer');

gulp.task('sass', function() {
    return gulp.src('sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compact'
        }).on('error', sass.logError))
        .pipe(prefixer({browsers: ['last 2 version','Android >= 4.0']}))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('dist/assets/css'));
});
gulp.task('watch', function(){
    gulp.watch('sass/**/*.scss', ['sass']);
});