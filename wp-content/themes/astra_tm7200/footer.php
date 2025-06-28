<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
</div> <!-- ast-container -->
</div><!-- #content -->
<?php
astra_content_after();


?>
<footer>
	<nav>
		<ul>
			<?php
			wp_nav_menu(array(
				'theme_location' => 'footer-menu',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'depth'          => 1,
			));
			?>
		</ul>
	</nav>
</footer>
</div><!-- #page -->
<?php
astra_body_bottom();
wp_footer();
?>
</body>

</html>