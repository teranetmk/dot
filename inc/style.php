<?php
/**
 * Requires the WP-SCSS plugin to be installed and activated.
 */


if ( ! function_exists( 'dotdigital_get_theme_colors_defaults' ) ) :
	/**
	 * Return default values for uninitialized theme mods.
	 * https://make.wordpress.org/themes/tag/theme-mods-api/
	 */

	function dotdigital_get_theme_colors_defaults() {
		$defaults = array(
			'color_1' => '#ff497c',
			'color_2' => '#a0ce4e',
			'color_3' => '#00bea3',
			'color_4' => '#f1894c',
		);
		return apply_filters( 'dotdigital_theme_colors_defaults', $defaults );
	}
endif;

/* dotdigital_set_color_palette */
if ( !function_exists( 'dotdigital_set_color_palette' ) ) {
	function dotdigital_set_color_palette() {
		$color_palette = dotdigital_get_theme_colors_defaults();
		$array = array();
		foreach($color_palette as $val) {
			$array[] = $val;
		}
		return $array;
	}
} //dotdigital_set_color_palette


if ( (!class_exists('Wp_Scss')) ) {
	return;
} else {
	/* Always recompile in the customizer */
	if ( is_customize_preview() && ! defined( 'WP_SCSS_ALWAYS_RECOMPILE' ) ) {
		define( 'WP_SCSS_ALWAYS_RECOMPILE', true );
	}

	/* dotdigital_scss_set_variables */
	if ( !function_exists( 'dotdigital_scss_set_variables' ) ) :
		function dotdigital_scss_set_variables() {
			/* Colors */
			$accent_color_1  = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'accent_color_1' ) : '';
			$accent_color_2  = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'accent_color_2' ) : '';
			$accent_color_3  = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'accent_color_3' ) : '';
			$accent_color_4  = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'accent_color_4' ) : '';


			/* Variables */
			$variables = array(

				/* Theme color scheme */
				'mainColor'             =>  $accent_color_1,
				'mainColor2'            =>  $accent_color_2,
				'mainColor3'            =>  $accent_color_3,
				'mainColor4'            =>  $accent_color_4,
			);

			return $variables;
		}
	endif; //dotdigital_scss_set_variables
	add_filter( 'wp_scss_variables', 'dotdigital_scss_set_variables' );
}