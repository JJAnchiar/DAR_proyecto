<?php

/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
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
<!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>

<head>
	<?php astra_head_top(); ?>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	if (apply_filters('astra_header_profile_gmpg_link', true)) {
	?>
		<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
	}
	?>
	<?php wp_head(); ?>
	<?php astra_head_bottom(); ?>
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>
	<?php astra_body_top(); ?>
	<?php wp_body_open(); ?>

	<a
		class="skip-link screen-reader-text"
		href="#content"
		title="<?php echo esc_attr(astra_default_strings('string-header-skip-link', false)); ?>">
		<?php echo esc_html(astra_default_strings('string-header-skip-link', false)); ?>
	</a>

	<div
		<?php
		echo wp_kses_post(
			astra_attr(
				'site',
				array(
					'id'    => 'page',
					'class' => 'hfeed site',
				)
			)
		);
		?>>

		<header>
			<!-- <img class="logo" src="<?php //echo get_stylesheet_directory_uri()
										?>/assets/images/logo.png" alt=""> -->
			<?php
			if (has_custom_logo()) {
				the_custom_logo();
			}
			?>

			<nav>
				<ul>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'head-menu',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'depth'          => 1,
					));
					?>
				</ul>
			</nav>
		</header>

		<?php



		astra_content_before();
		?>
		<div id="content" class="site-content">
			<div class="ast-container">
				<?php astra_content_top(); ?>