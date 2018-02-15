<?php
/**
 * Template part for displaying single items
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Review_Site
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="single-container">
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-2 col-sm-push-7">
        <div class="rating-wrap">
          <?php
          $cpt = array( 'movies', 'books', 'games' );
          if ( is_singular( $cpt ) ):
            $id = get_the_ID();
            $comments = get_comments( $id );
            foreach ( $comments as $comment ) :
              if ( $id == $comment->comment_post_ID ) {
                $all_ratings[] = get_comment_meta( $comment->comment_ID, 'rating', true );
              }
            endforeach;
            $average = array_sum( $all_ratings ) / count( $all_ratings ); ?>
              <h1><img src="<?php echo get_template_directory_uri() . '/img/star.png' ?>" alt="">  <?php echo $average; ?></h1>
            <?php
          endif;
          ?>
        </div>
      </div>
      <div class="col-sm-7 col-sm-pull-2">
        <h1><?php the_title();?></h1>
      </div>
      <div class="col-sm-3">
        <h3 class="hidden-xs">Categories</h3>
        <div class="categories-list">
          <nav class="categories-navigation navbar navbar-default">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#categories-collapse" aria-expanded="false">
                <img src="<?php echo get_template_directory_uri() . '/img/plus.png' ?>" alt="">
              </button>
              <div class="categories hidden-sm hidden-md hidden-lg">
                <p>Categories</p>
              </div>
            </div>
            <?php

            if ( is_singular('movies') ) {
              $menu = 'Movies Menu';
              $theme_location = 'movies-menu';
            }
            if ( is_singular('books') ) {
              $menu = 'Books Menu';
              $theme_location = 'books-menu';
            }
            if ( is_singular('games') ) {
              $menu = 'Games Menu';
              $theme_location = 'games-menu';
            }
              wp_nav_menu( array(
                'menu'              => $menu,
                'theme_location'    => $theme_location,
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'categories-collapse',
                'menu_class'        => 'nav navbar-nav'
                )
              );
            ?>
          </nav>
        </div>
      </div>
      <div class="col-sm-9">
        <?php
          $image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        ?>
        <div class="single-img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
        <?php
        if ( is_singular( 'post') ): ?>
          <div class="post-date">
            <p><?php the_time('F j, Y'); ?></p>
          </div>
        <?php
        endif;
        ?>
        <div class="single-content">
          <p><?php the_content(); ?></p>
        </div>
        <div class="comments-wrap">
          <?php comments_template(); ?>
        </div>
      </div>
    </div>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->
