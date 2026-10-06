<?php
/**
 * Rank Math Breadcrumb Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Breadcrumb_SEO_Rank_Math_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rank_math_breadcrumb_seo_widget';
	}

	public function get_title() {
		return esc_html__( 'Rank Math Breadcrumb', 'breadcrumb-seo-widget' );
	}

	public function get_icon() {
		return 'eicon-product-breadcrumbs';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Settings', 'breadcrumb-seo-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hide_last_page',
			[
				'label' => esc_html__( 'Hide Current Page?', 'breadcrumb-seo-widget' ),
				'description' => esc_html__( 'Hides the title of the current page at the end of the breadcrumb.', 'breadcrumb-seo-widget' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'breadcrumb-seo-widget' ),
				'label_off' => esc_html__( 'No', 'breadcrumb-seo-widget' ),
				'return_value' => 'none',
				'selectors' => [
					'{{WRAPPER}} .custom-rank-math-breadcrumb .last' => 'display: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Breadcrumb Styles', 'breadcrumb-seo-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'breadcrumb_typography',
				'selector' => '{{WRAPPER}} .custom-rank-math-breadcrumb, {{WRAPPER}} .custom-rank-math-breadcrumb span, {{WRAPPER}} .custom-rank-math-breadcrumb a',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Normal Text Color', 'breadcrumb-seo-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom-rank-math-breadcrumb' => 'color: {{VALUE}};',
					'{{WRAPPER}} .custom-rank-math-breadcrumb span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .custom-rank-math-breadcrumb .separator' => 'color: {{VALUE}};', /* Targets the separator specifically */
					'{{WRAPPER}} .custom-rank-math-breadcrumb .last' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Link Color', 'breadcrumb-seo-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom-rank-math-breadcrumb a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .custom-rank-math-breadcrumb span a' => 'color: {{VALUE}};',
			],
			]
		);

		$this->add_control(
			'link_hover_color',
			[
				'label' => esc_html__( 'Link Color (Hover)', 'breadcrumb-seo-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom-rank-math-breadcrumb a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .custom-rank-math-breadcrumb span a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
			echo '<div class="custom-rank-math-breadcrumb">';
			rank_math_the_breadcrumbs();
			echo '</div>';
		} else {
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				echo '<div class="custom-rank-math-breadcrumb" style="color:red; font-style:italic;">';
				echo esc_html__( 'The Rank Math SEO plugin must be active and the Breadcrumbs option enabled in the Rank Math settings.', 'breadcrumb-seo-widget' );
				echo '</div>';
			}
		}
	}
}
