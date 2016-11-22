<?php
/**
 * The template used for displaying blog image large post.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php do_action( 'spacious_before_post_content' ); ?>
<?php
if( has_post_thumbnail() ) {
    $image = '';
    $title_attribute = get_the_title( $post->ID );
    $image .= '<figure class="post-featured-image">';
    $image .= get_the_post_thumbnail( $post->ID, 'wcr_banner', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) );
    $image .= '</figure>';

    echo $image;
}
?>

    <div class="entry-content clearfix">
<?php
the_content();
?>
    </div>
    <footer class="entry-meta-bar clearfix">
        <div class="entry-meta clearfix">
        <?php edit_post_link( __( 'Edit', 'spacious' ), '<span class="edit-link">', '</span>' ); ?>
        </div>
    </footer>
<?php
do_action( 'spacious_after_post_content' );
?>
</article>
<div>
  <?php if ($post->ID == 13): ?>
    <?php the_widget( 'wcr_featured_widget', array('cat_id' => 3, 'title' => 'Current Sales', 'disable_feature_image' => false, 'image_position' => 'below') ); ?>
  <?php endif; ?>
  <?php if ($post->ID == 20): ?>
    <?php the_widget( 'wcr_featured_widget', array('cat_id' => 4, 'title' => 'Current Properties', 'disable_feature_image' => false, 'image_position' => 'below') ); ?>
  <?php endif; ?>

</div>

