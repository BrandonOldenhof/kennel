# Main file

The main file (usually labelled `app.scss`) should be the only Sass file, except for the files in the `vendor` directory, from the whole code base not to begin with an underscore. This file should not contain anything but `@import` and comments.
SCSS files in the `vendor` directory should NOT start with an underscore but should be compiled to separate CSS files through the Laravel Mix SASS compiler.

Reference: [Sass Guidelines](http://sass-guidelin.es/) > [Architecture](http://sass-guidelin.es/#architecture) > [Main file](http://sass-guidelin.es/#main-file)
