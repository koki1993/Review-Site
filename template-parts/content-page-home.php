<?php
/**
 * Template part for displaying page content in home page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Review Site
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
    $img = get_field('welcome_image');
    $title = get_field('welcome_title');
    $text = get_field('welcome_text');
  ?>
  <div class="welcome-text-wrap" style="background-image:url(<?php echo $img; ?>);">
    <div class="welcome-text">
      <h1><?php echo $title; ?></h1>
      <p><?php echo $text; ?></p>
    </div>
  </div>
  <div class="home-container">
    <div class="recent-posts-pc hidden-xs">
      <div class="row">
        <?php
        $all_cpts = array( 'movies', 'books', 'games' );
        foreach ($all_cpts as $cpt) :
          $post_object = get_post_type_object($cpt);
          ?>
          <div class="nav-wrap col-sm-12">
            <h2><?php echo $post_object->label; ?></h2>
            <a href="<?php echo get_post_type_archive_link($cpt); ?>">
              <button type="button" name="button">View All</button>
            </a>
          </div>
          <?php

            $args = array(
              'post_type'   => $cpt,
              'posts_per_page'  => 4,
            );
            // The Query
            $query1 = new WP_Query( $args ); ?>
            <?php
            if ( $query1->have_posts() ):
              // The Loop
              while ( $query1->have_posts() ):
                $query1->the_post(); ?>
                <div class="col-sm-3">
                  <div class="item-wrap">
                    <div class="home-img-wrap">
                      <?php
                      $image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                      ?>
                      <img src="<?php echo $image; ?>" alt="">
                    </div>
                    <div class="single-title">
                      <h3><?php echo the_title(); ?></h3>
                    </div>
                    <div class="rating-wrap">
                      <?php
                      $id = get_the_ID();
                      $comments = get_comments( $id );
                      foreach ( $comments as $comment ) :
                        if ( $id == $comment->comment_post_ID ) {
                          $all_ratings = get_comment_meta( $comment->comment_ID, 'rating', true );
                          $total[] = $all_ratings;
                        }
                      endforeach;
                      $average = array_sum( $total ) / count( $total ); ?>
                      <h3><img src="<?php echo get_template_directory_uri() . '/img/star-small.png' ?>" alt="">  <?php echo $average; ?></h3>
                      <?php unset($total); ?>
                    </div>
                  </div>
                </div>
                <?php
              endwhile;
              wp_reset_postdata();
            endif;
          endforeach;
          ?>
      </div>
    </div>

    <div class="recent-posts-mobile hidden-sm hidden-md hidden-lg">
      <div class="row">
        <?php
        $all_cpts = array( 'movies', 'books', 'games' );
        foreach ($all_cpts as $cpt) :
          $post_object = get_post_type_object($cpt);
          ?>
          <div class="nav-wrap col-sm-12">
            <h2><?php echo $post_object->label; ?></h2>
          </div>
          <?php

            $args = array(
              'post_type'   => $cpt,
              'posts_per_page'  => 2,
            );
            // The Query
            $query1 = new WP_Query( $args ); ?>
            <?php
            if ( $query1->have_posts() ):
              // The Loop
              while ( $query1->have_posts() ):
                $query1->the_post(); ?>
                <div class="col-xs-6">
                  <div class="item-wrap">
                    <div class="home-img-wrap">
                      <?php
                      $image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                      ?>
                      <img src="<?php echo $image; ?>" alt="">
                    </div>
                  </div>
                </div>
                <?php
              endwhile; ?>
              <div class="col-xs-12">
                <a href="<?php echo get_post_type_archive_link($cpt); ?>">
                  <button type="button" name="button">View All</button>
                </a>
              </div>
              <?php
              wp_reset_postdata();
            endif;
          endforeach;
          ?>
      </div>
    </div>
  </div>
</article>
