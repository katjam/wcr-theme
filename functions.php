<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
add_action( 'wp_enqueue_scripts', 'enqueue_compiled_styles');

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function enqueue_compiled_styles() {
  wp_enqueue_style( 'wcr-sass-main',
      get_stylesheet_directory_uri().'/stylesheets/screen.css'
  );
  wp_enqueue_style( 'wcr-sass-print',
    get_stylesheet_directory_uri().'/stylesheets/print.css',
    array(), false, 'print'
  );
  wp_enqueue_style( 'wcr-sass-ie',
    get_stylesheet_directory_uri().'/stylesheets/ie.css'
  );
  // Could also use conditional 'lt IE 9' or 'IE 7' etc.
  wp_style_add_data( 'wcr-sass-ie', 'conditional', 'IE');
}
