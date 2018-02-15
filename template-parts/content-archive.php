<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Review_Site
 */
?>
  <?php
    $image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
  ?>
<div class="col-sm-4">
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="item-wrap">
      <div class="item-img" style="background-image:url(<?php echo $image; ?>);"></div>
      <div class="info-wrap">
        <div class="single-title-wrap">
          <a href="<?php echo esc_url( the_permalink() ); ?>"><h3><?php the_title(); ?></h3></a>
        </div>
        <div class="rating-wrap">
          <?php
          $id = get_the_ID();
          $comments = get_comments( $id );
          foreach ( $comments as $comment ) :
            if ( $id == $comment->comment_post_ID ) {
              $all_ratings[] = get_comment_meta( $comment->comment_ID, 'rating', true );
            }
          endforeach;
          $average = array_sum( $all_ratings ) / count( $all_ratings ); ?>
          <h3><img src="<?php echo get_template_directory_uri() . '/img/star-small.png' ?>" alt="">  <?php echo $average; ?></h3>
          <?php
          ?>
        </div>
      </div>
      <?php if ( is_post_type_archive('movies') ) {
        $taxonomy = 'movie_type';
      } ?>
      <?php if ( is_post_type_archive( 'books' ) ) {
        $taxonomy = 'book_type';
      } ?>
      <?php if ( is_post_type_archive( 'games' ) ) {
        $taxonomy = 'game_type';
      }
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
</div>
