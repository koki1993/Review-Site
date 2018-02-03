<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Review Site
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
    $image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    remove_filter('the_content', 'wpautop');
  ?>
  <div class="about-img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
  <div class="about-container">
    <h1><?php the_title(); ?></h1>
    <p><?php the_content(); ?></p>

  </div>
</article>
