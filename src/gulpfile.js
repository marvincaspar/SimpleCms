var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

var input = './resources/assets/sass/app.scss';
var output = './public/css';

gulp.task('sass', function () {
    return gulp
        .src(input)
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(gulp.dest(output));
});
