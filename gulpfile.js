
var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();

const notifier = require('node-notifier');

var path = require('path');
var util = require('util');
var fs   = require('fs');
var expand = require('expand-braces');
var crc = require('crc');
var del = require('del');

var config = require('./package.json');
config.preprocessor = config.preprocessor || 'sass'; // default to sass

var postProcessors = [];
config.postProcessors.forEach(function(p) {
  var f = require(p[0]);
  postProcessors.push(f.apply(null, p.slice(1)));
});

var paths = config.paths;
paths.res_src = paths.src + '**/*.{min.js,min.css,png,jpg,gif,swf,htc,eot,svg,ttf,woff,woff2,php,json,html}';
paths.style_src = paths.src + ({ sass: 'scss/**/*.scss', less: 'less/**/*.less' }[config.preprocessor]);

function notify(err) {
  var title = err.plugin + ' ' + err.name;
  var msg = err.message;
  notifier.notify({
    title: title,
    message: msg,
    sound: 'Morse'
  });
  this.emit('end');
}

var urlPattern = /url\(\s*(['"]?)(\/assets\/)([^'" \)]*)\1\s*\)/g;
var hashCache = {};
function replaceUrl($0, $1, $prefix, $src) {
  $src = $src.replace(/\?.*/, ''); // remove url params
  var filePath = path.resolve(paths.src + $src);
  // TODO: get sass src
  var from = path.resolve(paths.src + 'css/');
  var src = path.relative(from, filePath).replace(/\\/g, '/');
  var params = '?v=';
  if(!fs.existsSync(filePath)) {
    var err = new Error('File not found "' + $src + '"');
    console.log(err);
    params += '404';
  } else {
    var hash = hashCache[filePath];
    if(!hash) {
      hash = crc.crc32(fs.readFileSync(filePath)).toString(16);
      hashCache[filePath] = hash;
    }
    params += hash;
  }
  return 'url(' + src + params + ')';
}

gulp.task(config.preprocessor, function() {
  var src_dest = paths.src + 'css/';
  var dest    = paths.dest + 'css/';
  return gulp.src(paths.style_src)
    .pipe(plugins[config.preprocessor](config.preprocessorOpts).on('error', notify))
    .pipe(plugins.postcss(postProcessors))
    .pipe(plugins.replace(urlPattern, replaceUrl))
    .pipe(gulp.dest(src_dest))
    .pipe(plugins.cleanCss({compatibility: 'ie8'}))
    .pipe(gulp.dest(dest));
});

gulp.task('styles', [config.preprocessor], function() {
  return gulp.src([paths.src + '**/*.css', '!**/*.min.css', '!' + paths.src + 'css/**/*.css'])
    .pipe(plugins.changed(paths.dest))
    .pipe(plugins.cleanCss())
    .pipe(gulp.dest(paths.dest));
});

gulp.task('scripts', function() {
  return gulp.src([paths.src + '**/*.js', '!**/*.min.js'])
    .pipe(plugins.changed(paths.dest))
    .pipe(plugins.uglify())
    .pipe(gulp.dest(paths.dest));
});

gulp.task('images', function() {
  try {
    // npm install gulp-imagemin imagemin-pngquant
    require.resolve("gulp-imagemin");
  } catch(e) {
    return console.log('No imagemin modules installed!');
  }
  var imagemin = require('gulp-imagemin');
  var pngquant = require('imagemin-pngquant');
  var img_src = paths.src + 'img/';
  var img_dest = paths.dest + 'img/';
  return gulp.src([ img_src + '**/*.*']) // Unsupported files are ignored.
    .pipe(plugins.changed(img_dest))
    .pipe(imagemin({
      progressive: true,
      use: [pngquant()]
    }))
    .pipe(gulp.dest(img_dest));
});

gulp.task('copy', ['images'], function() {
  return gulp.src(paths.res_src)
    .pipe(plugins.changed(paths.dest))
    .pipe(gulp.dest(paths.dest));
});

function concatFiles(files, cwd) {
  // merge-stream
  var target, sources;
  for(target in files) {
    sources = expand(files[target]);
    sources.forEach(function(f) {
      if(!fs.existsSync(cwd + f)) {
        throw new Error('File not found "' + cwd + f + '"');
      }
    });
    console.log('%s <= [ %s ]', target, files[target].join(', '));
    gulp.src(sources, { cwd:  cwd})
      .pipe(plugins.concat(path.basename(target)))
      .pipe(gulp.dest(cwd + path.dirname(target)));
  }
}

gulp.task('concat', ['styles', 'scripts'], function() {
  concatFiles(config.combos, paths.dest);
});

// concat files as needed
gulp.task('prepare', function() {
  concatFiles(config.preCombos, paths.src);
});

gulp.task('watch', [config.preprocessor], function() {
  console.log('Watching to compile %s files...', config.preprocessor);
  gulp.watch(paths.style_src, [config.preprocessor]);
});

gulp.task('dist', ['copy', 'concat']);

gulp.task('default', ['dist']);
