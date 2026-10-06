<?php
/**
 * Plugin Name: Breadcrumb SEO Widget for Elementor
 * Plugin URI: https://github.com/seu-usuario/breadcrumb-seo-widget-for-elementor
 * Description: Elementor widget to display Yoast SEO or Rank Math SEO breadcrumbs with advanced styling options.
 * Version: 1.0.0
 * Author: Gustavo Rodrigues
 * Author URI: https://github.com/seu-usuario
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: breadcrumb-seo-widget
 * Domain Path: /languages
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Load plugin textdomain for translations
 */
function breadcrumb_seo_widget_load_textdomain() {
	load_plugin_textdomain(
		'breadcrumb-seo-widget',
		false,
		basename( dirname( __FILE__ ) ) . '/languages/'
	);
}
add_action( 'plugins_loaded', 'breadcrumb_seo_widget_load_textdomain' );

/**
 * Register widgets conditionally based on active SEO plugins
 */
function register_breadcrumb_seo_widgets( $widgets_manager ) {
	// Check if Elementor is loaded
	if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
		return;
	}

	// Register Yoast Breadcrumb Widget if Yoast is active
	if ( defined( 'WPSEO_VERSION' ) || function_exists( 'yoast_breadcrumb' ) ) {
		require_once( __DIR__ . '/widgets/yoast-breadcrumb-widget.php' );
		$widgets_manager->register( new \Breadcrumb_SEO_Yoast_Widget() );
	}

	// Register Rank Math Breadcrumb Widget if Rank Math is active
	if ( defined( 'RANK_MATH_VERSION' ) || class_exists( 'RankMath' ) || function_exists( 'rank_math_the_breadcrumbs' ) ) {
		require_once( __DIR__ . '/widgets/rank-math-breadcrumb-widget.php' );
		$widgets_manager->register( new \Breadcrumb_SEO_Rank_Math_Widget() );
	}
}
add_action( 'elementor/widgets/register', 'register_breadcrumb_seo_widgets' );
