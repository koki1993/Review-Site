<?php
/**
 * The template for displaying cpt archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Review_Site
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="archive-container">
				<h1><?php post_type_archive_title(); ?></h1>
				<div class="row">
					<div class="col-sm-3">
		        <h3 class="hidden-xs">Categories</h3>
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
							if ( is_post_type_archive('movies') ) {
						    $menu = 'Movies Menu';
								$theme_location = 'movies-menu';
						  }
							if ( is_post_type_archive('books') ) {
						    $menu = 'Books Menu';
								$theme_location = 'books-menu';
						  }
							if ( is_post_type_archive('games') ) {
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
					<div class="col-sm-9">
						<div class="row">
		<?php
		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
						</div>
						<div class="page-navigation">
							<?php wpbeginner_numeric_posts_nav(); ?>
						</div>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
