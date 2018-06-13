<?php

/**
 * Class WP_EXT_Widget_Theme
 * ------------------------------------------------------------------------------------------------------------------ */

class WP_EXT_Widget_Theme extends WP_EXT_Widget {

	/**
	 * Constructor.
	 * -------------------------------------------------------------------------------------------------------------- */

	public function __construct() {
		parent::__construct();

		$this->run();
	}

	/**
	 * Plugin: `initialize`.
	 * -------------------------------------------------------------------------------------------------------------- */

	public function run() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_style' ], 92 );
		add_filter( 'body_class', [ $this, 'body_class' ] );
	}

	/**
	 * Enqueue style.
	 * -------------------------------------------------------------------------------------------------------------- */

	public function enqueue_style() {
		if ( ! is_admin() ) {
			wp_enqueue_style( 'ext-plugin-' . $this->domain_ID, plugins_url( 'themes/styles/theme.css', __DIR__ ), [], '' );
		}
	}

	/**
	 * Body class.
	 *
	 * @return array
	 * -------------------------------------------------------------------------------------------------------------- */

	public function body_class( $classes ) {
		if ( ! is_admin() ) {
			$classes[] = 'ext-plugin-' . $this->domain_ID;
		}

		return $classes;
	}
}

/**
 * Helper function to retrieve the static object without using globals.
 *
 * @return WP_EXT_Widget_Theme
 * ------------------------------------------------------------------------------------------------------------------ */

function WP_EXT_Widget_Theme() {
	static $object;

	if ( null == $object ) {
		$object = new WP_EXT_Widget_Theme;
	}

	return $object;
}

/**
 * Initialize the object on `plugins_loaded`.
 * ------------------------------------------------------------------------------------------------------------------ */

add_action( 'plugins_loaded', [ WP_EXT_Widget_Theme(), 'run' ] );
