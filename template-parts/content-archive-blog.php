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
  <div class="item-wrap">
    <div class="item-img">
      <img src="<?php echo $image; ?>" alt="">
    </div>
    <div class="post-date">
      <p><?php the_time('F j, Y'); ?></p>
    </div>
    <div class="post-title">
      <a href="<?php echo esc_url( the_permalink() ); ?>"><h3><?php the_title(); ?></h3></a>
    </div>
    <div class="single-content hidden-xs">
      <p><?php the_content(); ?></p>
    </div>
    <?php
    $terms = get_the_terms( get_the_ID(), $taxonomy );
    if ( $terms && ! is_wp_error( $terms ) ) :
        $movie_categories = array();
        foreach ( $terms as $term ) {
            $movie_categories[] = $term->name;
        }
        $movie_categorie = join( ", ", $movie_categories );
        ?>
        <p class="archive-categories">
            <?php printf( esc_html__( '%s', 'textdomain' ), esc_html( $movie_categorie ) ); ?>
        </p>
    <?php endif; ?>
  </div>
</div>
