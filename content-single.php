<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'spacious_before_post_content' ); ?>
    <div class="entry-content clearfix">
        <?php
            if (has_post_thumbnail()) {
                echo get_the_post_thumbnail($post->ID, 'featured');
            }
        ?>
		<?php
			the_content();
        ?>
	</div>
	<?php
	    do_action( 'spacious_after_post_content' );
    ?>
</article>
