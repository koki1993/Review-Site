<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Review_Site
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'review-site' ); ?></a>

	<header id="masthead" class="site-header">
		<nav class="main-navigation navbar navbar-default">
		  <div class="custom-container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-collapse" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
					<div class="logo">
						<?php
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$image = wp_get_attachment_image_src( $custom_logo_id , 'small' );
						?>
						<a href="<?php echo home_url(); ?>"><img src="<?php echo $image[0]; ?>" class="site-logo"></a>
					</div>
		    </div>
				<?php
					wp_nav_menu( array(
						'menu'              => 'Primary Menu',
						'theme_location'    => 'primary-menu',
						'container_class'   => 'collapse navbar-collapse',
						'container_id'      => 'primary-collapse',
						'menu_class'        => 'nav navbar-nav navbar-right'
						)
					);
				?>
  		</div><!-- .container -->
		</nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
