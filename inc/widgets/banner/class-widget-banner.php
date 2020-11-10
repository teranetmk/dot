<?php if ( ! defined( 'ABSPATH' ) ) {
	die();
}
if ( ( defined( 'FW' ) ) && ! ( class_exists( 'Dotdigital_Widget_Banner' ) ) ) :

class Dotdigital_Widget_Banner extends WP_Widget {

	/**
	 * Widget constructor.
	 */
	private $options;
	private $prefix;

	function __construct() {

		$widget_ops = array(
			'classname'   => 'widget_banner',
			'description' => esc_html__( 'Add linked image with text', 'dotdigital' ),
		);

		parent::__construct( false, esc_html__( 'Theme - Ad Banner', 'dotdigital' ), $widget_ops );

		//Create our options by using Unyson option types
		$this->options = array(
			'title' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Widget Title', 'dotdigital' ),
			),
			'image' => array(
				'type'        => 'upload',
				'value'       => '',
				'label'       => esc_html__( 'Banner Image', 'dotdigital' ),
				'images_only' => true,
			),
			'url'   => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Banner URL', 'dotdigital' ),
			),

		);
		$this->prefix  = 'widget_banner';
	}

	function widget( $args, $instance ) {
		extract( wp_parse_args( $args ) );

		$params = array();

		foreach ( $instance as $key => $value ) {
			$params[ $key ] = $value;
		}

		$instance = $params;

		$filepath = get_template_directory() . '/inc/widgets/banner/views/widget.php';

		if ( file_exists( $filepath ) ) {
			include( $filepath );
		} else {
			_e( 'View not found', 'dotdigital' );
		}
	}

	function update( $new_instance, $old_instance ) {
		return fw_get_options_values_from_input(
			$this->options,
			FW_Request::POST( fw_html_attr_name_to_array_multi_key( $this->get_field_name( $this->prefix ) ), array() )
		);
	}

	function form( $values ) {

		$prefix = $this->get_field_id( $this->prefix ); // Get unique prefix, preventing duplicated key
		$id     = 'fw-widget-options-' . $prefix;

		// Print our options
		echo '<div class="fw-force-xs fw-theme-admin-widget-wrap fw-framework-widget-options-widget" data-fw-widget-id="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '">';

		echo fw()->backend->render_options( $this->options, $values, array(
			'id_prefix'   => $prefix . '-',
			'name_prefix' => $this->get_field_name( $this->prefix ),
		) );
		echo '</div>';

		return $values;
	}
}

endif;