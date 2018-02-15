<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Review_Site
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div class="footer">
				<div class="footer-content">
					<div class="row">
						<?php if( is_active_sidebar( 'quicklinks' ) ) : ?>
							<div class="col-xs-6 col-sm-3">
								<?php dynamic_sidebar( 'quicklinks' ); ?>
							</div>
						<?php endif; ?>
						<?php if( is_active_sidebar( 'about' ) ) : ?>
							<div class="col-xs-6 col-sm-4">
								<?php dynamic_sidebar( 'about' ); ?>
							</div>
						<?php endif; ?>
						<div class=" col-xs-12 col-sm-5">
							<div class="newsletter">
								<h2>Newsletter</h2>
								<input type="text" name="Email" placeholder="Email" value="">
								<button type="submit" name="button">></button>
							</div>
						</div>
					</div>
					<p class="copyright-text">&copy; <?php echo date('Y'); ?> Review Site</p>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
