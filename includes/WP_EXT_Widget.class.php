<?php

/**
 * Class WP_EXT_Widget
 * ------------------------------------------------------------------------------------------------------------------ */

class WP_EXT_Widget {

	/**
	 * Textdomain used for translation.
	 *
	 * @var string
	 * -------------------------------------------------------------------------------------------------------------- */

	protected $domain_ID;

	/**
	 * Post type name.
	 *
	 * @var string
	 * -------------------------------------------------------------------------------------------------------------- */

	/**
	 * Constructor.
	 * -------------------------------------------------------------------------------------------------------------- */

	public function __construct() {
		// Settings.
		$this->domain_ID  = 'widget';

		// Languages.
		self::languages();

		// Initialize.
		$this->run();
	}

	/**
	 * Plugin: `initialize`.
	 * -------------------------------------------------------------------------------------------------------------- */

	public function run() {
	}

	/**
	 * Plugin: `languages`.
	 * -------------------------------------------------------------------------------------------------------------- */

	public function languages() {
		load_plugin_textdomain(
			'wp-ext-' . $this->domain_ID,
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages/'
		);
	}
}

/**
 * Helper function to retrieve the static object without using globals.
 *
 * @return WP_EXT_Widget
 * ------------------------------------------------------------------------------------------------------------------ */

function WP_EXT_Widget() {
	static $object;

	if ( null == $object ) {
		$object = new WP_EXT_Widget;
	}

	return $object;
}

/**
 * Initialize the object on `plugins_loaded`.
 * ------------------------------------------------------------------------------------------------------------------ */

add_action( 'plugins_loaded', [ WP_EXT_Widget(), 'run' ] );
