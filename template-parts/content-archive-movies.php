<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Review_Site
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
    $image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
  ?>
  <div class="movie-wrap">
    <div class="movie-img">
      <img src="<?php echo $image; ?>" alt="">
    </div>
    <h3><?php the_title(); ?></h3>
  </div>
</div>
