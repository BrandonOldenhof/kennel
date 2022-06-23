const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
// require("laravel-mix-purgecss");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .js("resources/js/app.js", "public/js")
  .js("resources/js/axe.js", "public/js");

mix
  .sass("resources/sass/app.scss", "public/css")
  .postCss("resources/css/tailwind.css", "public/css/tailwind.css", [
    require("postcss-import"),
    require("tailwindcss"),
    require("postcss-nested"),
    require("postcss-focus-visible"),
    require("autoprefixer"),
  ]);

// Uncomment when using Fontawesome
// mix
//   .sass("resources/sass/vendors/fontawesome.scss", "public/css")
//   .purgeCss({
//     enabled: true,
//   })
//   .copy(
//     "node_modules/@fortawesome/fontawesome-free/webfonts/",
//     "public/webfonts/"
//   );

mix.copy("resources/favicons/!(*.md)", "public/favicons");

mix.options({
  cssNano: { minifyFontValues: false },
  processCssUrls: false,
  postCss: [tailwindcss("./tailwind.config.js")],
});

mix.browserSync({
  https: true,
  proxy: process.env.MIX_BROWSERSYNC_PROXY,
  files: [
    "app/**/*.php",
    "resources/views/**/*.php",
    "resources/views/**/*.html",
    "public/**/*.(css|js)",
  ],
  notify: false,
  open: false,
});

mix.version();
