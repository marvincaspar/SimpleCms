var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var merge = require('merge-stream');
var uncss = require('gulp-uncss');

var inputSite = './resources/assets/sass/site/app.scss';
var outputSite = './public/css/site';
var inputAdmin = './resources/assets/sass/admin/app.scss';
var outputAdmin = './public/css/admin';

var inputJs = './resources/assets/js/**/*';
var outputJs = './public/js';

gulp.task('sass', function () {
    return merge(
        gulp
            .src(inputSite)
            .pipe(sass())
            .pipe(autoprefixer())
            .pipe(gulp.dest(outputSite)),
        gulp
            .src(inputAdmin)
            .pipe(sass())
            .pipe(autoprefixer())
            .pipe(gulp.dest(outputAdmin))
    );
});

gulp.task('js', function () {
    return merge(
        gulp
            .src(inputJs)
            .pipe(gulp.dest(outputJs))
    );
});

gulp.task('uncss', function () {
    return gulp.src('./public/css/admin/app.css')
        .pipe(uncss({
            html: ['https://tiwaplan.dev.io/dashboard']
        }))
        .pipe(gulp.dest('./out'));
});

gulp.task('default', ['sass', 'js']);
