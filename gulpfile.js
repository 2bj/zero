( function() {

  var
    gulp = require( 'gulp' ),
    autoprefixer = require( 'gulp-autoprefixer' ),
    concat = require( 'gulp-concat' ),
    minifycss = require( 'gulp-minify-css' ),
    plumber = require( 'gulp-plumber' ),
    sass = require( 'gulp-ruby-sass' ),
    uglify = require( 'gulp-uglify' ),
    base64 = require('gulp-base64');

  var src = {
    base: [ 'src' ],
    styles: [ 'src/styles/**/*.sass' ],
    images: [ 'src/images/**/*.{gif,jpg,png,svg}' ],
    scripts: [
      'bower_components/jquery/dist/jquery.js',
      'bower_components/fotorama/fotorama.js',
      'bower_components/fitvids/jquery.fitvids.js',
      'bower_components/jquery.autoGrowInput/jquery.autoGrowInput.js',
      'bower_components/jquery-masonry/dist/masonry.pkgd.js',
      'bower_components/photoset-grid/jquery.photoset-grid.min.js',
      'src/scripts/share.js',
      'src/scripts/scripts.js'
    ]
  }
  var dist = {
    styles: 'assets/styles',
    images: 'assets/images',
    scripts: 'assets/scripts'
  }

  gulp.task( 'images', function() {
    return gulp.src( src.images ).pipe( gulp.dest( dist.images ) );
  } );

  // styles
  gulp.task( 'styles', function() {
    return gulp
      .src( src.styles )
      .pipe( plumber() )
      .pipe( sass( {
        sourcemap: false,
        quiet: true,
        style: 'compressed'
      } ) )
      .pipe( base64( {
        extensions: [ 'svg', 'png' ],
        maxImageSize: 8*1024,
        debug: false
      } ) )
      .pipe( autoprefixer( 'last 2 version', 'safari 5', 'ie 8', 'ie 7', 'opera 12.1', 'ios 6', 'android 4' ) )
      .pipe( minifycss() )
      .pipe( gulp.dest( dist.styles ) );
  } );

  // scripts
  gulp.task( 'scripts', function() {
    return gulp
      .src( src.scripts )
      .pipe( plumber() )
      .pipe( concat( 'scripts.js' ) )
      .pipe( uglify() )
      .pipe( gulp.dest( dist.scripts ) );
  } );

  // watch
  gulp.task( 'watch', [ 'build' ], function() {
    gulp.watch( src.scripts, [ 'scripts' ] );
    gulp.watch( src.styles, [ 'styles' ] );
  } );

  gulp.task( 'build', [ 'styles', 'scripts', 'images' ] );
  gulp.task( 'default', [ 'watch' ] );

} )();