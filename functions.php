<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
add_action( 'wp_enqueue_scripts', 'enqueue_compiled_styles');
add_action( 'wcr_footer_copyright', 'wcr_footer_copyright', 10 );

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
  wp_enqueue_style( 'font-awesome',
      get_stylesheet_directory_uri().'/stylesheets/font-awesome.min.css'
  );

}

// Add image size.
add_image_size( 'wcr_banner', 1268, 550, array('center', 'center') );

// Allow svg upload for logo
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function wcr_footer_copyright() {
  $copyright_txt = 'Copyright &copy; '.date('Y').' West Country Rural Ltd.';
  $theme_info = ' Registered in England & Wales under Company Registration No. 1029475';
  $copyright_info = '<div class="copyright">'.$copyright_txt.$theme_info.'</div>';
  echo $copyright_info;
}

function wcr_allowedtags() {
    // Add custom tags to this string
        return '<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<img>,<video>,<audio>';
    }

if ( ! function_exists( 'wcr_custom_wp_trim_excerpt' ) ) :

    function wcr_custom_wp_trim_excerpt($wcr_excerpt) {
    $raw_excerpt = $wcr_excerpt;
        if ( '' == $wcr_excerpt ) {

            $wcr_excerpt = get_the_content('');
            $wcr_excerpt = strip_shortcodes( $wcr_excerpt );
            $wcr_excerpt = apply_filters('the_content', $wcr_excerpt);
            $wcr_excerpt = str_replace(']]>', ']]&gt;', $wcr_excerpt);
            $wcr_excerpt = strip_tags($wcr_excerpt, wcr_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.
                $excerpt_word_count = 75;
                $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wcr_excerpt, $tokens);

                foreach ($tokens[0] as $token) {

                    if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) {
                    // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }

                    // Add words to complete sentence
                    $count++;

                    // Append what's left of the token
                    $excerptOutput .= $token;
                }

            $wcr_excerpt = trim(force_balance_tags($excerptOutput));

            return $wcr_excerpt;

        }
        return apply_filters('wcr_custom_wp_trim_excerpt', $wcr_excerpt, $raw_excerpt);
    }

endif;

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wcr_custom_wp_trim_excerpt');
