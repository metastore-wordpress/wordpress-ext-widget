<?php

/**
 * Class WP_EXT_Widget_ChildPage
 */
class WP_EXT_Widget_ChildPage extends WP_Widget {

	/**
	 * Textdomain used for translation.
	 *
	 * @var string
	 */
	private $domain_ID;

	/**
	 * Constructor. Register widget with WordPress.
	 */
	public function __construct() {
		$this->domain_ID = 'child-page';

		$args = [
			'classname'   => 'wp-ext-' . $this->domain_ID,
			'description' => esc_html__( 'Displays child pages.', 'wp-ext-' . $this->domain_ID ),
		];

		parent::__construct(
			'wp-ext-' . $this->domain_ID,
			esc_html__( 'Child Pages', 'wp-ext-' . $this->domain_ID ),
			$args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		/**
		 * Options.
		 */
		$title = esc_html__( 'Страницы', 'wp-ext-' . $this->domain_ID );

		/**
		 * Rendering data.
		 */
		if ( self::child_page_list() ) {
			echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
			echo self::child_page_list();
			echo $args['after_widget'];
		}
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance The widget options.
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 *
	 * @return array|void
	 */
	public function update( $new_instance, $old_instance ) {
	}

	/**
	 * Render `child_page_list`.
	 *
	 * @return string
	 */
	public function child_page_list() {
		global $post;

		$children = '';
		$out      = '';

		if ( ! $post->post_parent ) {
			$children = wp_list_pages( [
				'sort_column' => 'menu_order',
				'title_li'    => '',
				'child_of'    => $post->ID,
				'echo'        => '0',
			] );
		} else {
			if ( $post->ancestors ) {
				$ancestors = end( $post->ancestors );
				$children  = wp_list_pages( [
					'sort_column' => 'menu_order',
					'title_li'    => '',
					'child_of'    => $ancestors,
					'echo'        => '0',
				] );
			}
		}

		if ( $children ) {
			$out = '<ul>' . $children . '</ul>';
		}

		return $out;
	}
}

/**
 * Register the widget.
 */
function WP_EXT_Widget_ChildPage_Register() {
	register_widget( 'WP_EXT_Widget_ChildPage' );
}

/**
 * Initialize on `widgets_init`.
 */
add_action( 'widgets_init', 'WP_EXT_Widget_ChildPage_Register' );
