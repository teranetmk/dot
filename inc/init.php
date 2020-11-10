<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * Theme Includes
 *
 * https://github.com/ThemeFuse/Theme-Includes
 */
class Dotdigital_Theme_Includes {
	private static $rel_path = null;

	private static $include_isolated_callable;

	private static $initialized = false;

	public static $template_directory = '';

	public static $template_directory_uri = '';

	public static function init() {
		if ( self::$initialized ) {
			return;
		} else {
			self::$initialized = true;
		}

		//theme path
		self::$template_directory = DOTDIGITAL_THEME_PATH;

		self::$template_directory_uri = DOTDIGITAL_THEME_URI;

		/**
		 * Include a file isolated, to not have access to current context variables
		 */
		self::$include_isolated_callable = function( $path ) {
			return include $path;
		};

		/**
		 * Both frontend and backend
		 */
		{
			self::include_child_first( '/helpers.php' );
			self::include_child_first( '/hooks.php' );
			self::include_child_first( '/style.php' );

			self::include_child_first( '/sub-includes/class-theme-comments-walker.php' );
			self::include_child_first( '/sub-includes/custom-kses.php' );
			self::include_child_first( '/sub-includes/template-tags.php' );
			self::include_child_first( '/sub-includes/icons-rt.php' );
			self::include_child_first( '/sub-includes/icons-social.php' );
			self::include_child_first( '/sub-includes/mod-post-adds.php' );
			self::include_child_first( '/sub-includes/woocommerce.php' );


			add_action( 'init', array( __CLASS__, '_action_init' ) );
			add_action( 'widgets_init', array( __CLASS__, '_action_widgets_init' ) );
		}

		/**
		 * Only frontend
		 */
		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, '_action_enqueue_scripts' ),
				20 // Include later to be able to make wp_dequeue_style|script()
			);
		}
	}

	private static function get_rel_path( $append = '' ) {
		if ( self::$rel_path === null ) {
			self::$rel_path = '/inc';
		}

		return self::$rel_path . $append;
	}

	/**
	 * @param string $dirname 'foo-bar'
	 *
	 * @return string 'Foo_Bar'
	 */
	private static function dirname_to_classname( $dirname ) {
		$class_name = explode( '-', $dirname );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );

		return $class_name;
	}

	public static function get_parent_path( $rel_path ) {
		return DOTDIGITAL_THEME_PATH . self::get_rel_path( $rel_path );
	}

	public static function get_child_path( $rel_path ) {
		if ( ! is_child_theme() ) {
			return null;
		}

		return get_stylesheet_directory() . self::get_rel_path( $rel_path );
	}

	public static function include_isolated( $path ) {
		call_user_func( self::$include_isolated_callable, $path );
	}

	public static function include_child_first( $rel_path ) {
		if ( is_child_theme() ) {
			$path = self::get_child_path( $rel_path );

			if ( file_exists( $path ) ) {
				self::include_isolated( $path );
			}
		}

		{
			$path = self::get_parent_path( $rel_path );

			if ( file_exists( $path ) ) {
				self::include_isolated( $path );
			}
		}
	}

	/**
	 * @internal
	 */
	public static function _action_enqueue_scripts() {
		self::include_child_first( '/static.php' );
	}

	/**
	 * @internal
	 */
	public static function _action_init() {
		self::include_child_first( '/menus.php' );
		self::include_child_first( '/posts.php' );
	}

	/**
	 * @internal
	 */
	public static function _action_widgets_init() {
		{
			$paths = array();

			if ( is_child_theme() ) {
				$paths[] = self::get_child_path( '/widgets' );
			}

			$paths[] = self::get_parent_path( '/widgets' );
		}

		$included_widgets = array();

		foreach ( $paths as $path ) {

			//all available theme widgets directories:
			//autoloading removed
			$dirs = array(
				'banner',
				'icons-list',
				'portfolio',
				'post-tabs',
				'posts',
				'socials',
				'theme-posts',
				'twitter',
			);

			foreach ( $dirs as $dir ) {
				$dirname = $dir;

				if ( isset( $included_widgets[ $dirname ] ) ) {
					// this happens when a widget in child theme wants to overwrite the widget from parent theme
					continue;
				} else {
					$included_widgets[ $dirname ] = true;
				}

				$path_to_widget_class = $dir . '/class-widget-' . $dirname;

				//checking that file exists in provided dirs
				$full_path_to_widget_class = self::$template_directory . '/inc/widgets/'. $dirname . '/class-widget-' . $dirname . '.php';
				if ( file_exists( $full_path_to_widget_class ) ) {
					self::include_isolated( $full_path_to_widget_class );

					$widget_class = 'Dotdigital_Widget_' . self::dirname_to_classname( $dirname );
					if ( class_exists( $widget_class ) ) {
						register_widget( $widget_class );
					}
				}
			}
		}
	}
}

Dotdigital_Theme_Includes::init();