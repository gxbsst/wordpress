<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package patrick
 * @since patrick 1.0
 */
?>
		<div id="secondary" class="widget-area grid_2" role="complementary">
			<ul>
				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
				<?php endif; ?>
			</ul>	
			<?php get_template_part( 'sponsors' ); ?>	
		</div><!-- #secondary .widget-area -->
