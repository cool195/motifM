// 引入 gulp
var gulp = require('gulp');

// 引入组件
var imagemin = require('gulp-imagemin'),//图片压缩
    pngcrush = require('imagemin-pngcrush'),
    minifycss = require('gulp-minify-css'),//css压缩
    uglify = require('gulp-uglify'),//js压缩
    concat = require('gulp-concat'),//文件合并
    rename = require('gulp-rename');//文件更名

// 压缩图片
    gulp.task('img', function() {
    return gulp.src('images/*/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngcrush()]
        }))
        .pipe(gulp.dest('min/images/'));
});

// 压缩图片
gulp.task('imgfile', function() {
    return gulp.src('images/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngcrush()]
        }))
        .pipe(gulp.dest('min/images/'));
});

// 合并、压缩、重命名css
gulp.task('css', function() {
    return gulp.src('styles/*.css')
        .pipe(rename({ suffix: '' }))
        .pipe(minifycss())
        .pipe(gulp.dest('min/styles'));
});

// 合并、压缩js文件
gulp.task('js', function() {
    return gulp.src('scripts/*.js')
        .pipe(rename({ suffix: '' }))
        .pipe(uglify())
        .pipe(gulp.dest('min/scripts'));
});

// 合并、压缩js文件
gulp.task('jstwo', function() {
    return gulp.src('scripts/*/*.js')
        .pipe(rename({ suffix: '' }))
        .pipe(uglify())
        .pipe(gulp.dest('min/scripts/'));
});

// 默认任务
gulp.task('default', function(){
    gulp.start('css','js','img');
    //gulp.start('js','jstwo','css','img','imgfile');
});
