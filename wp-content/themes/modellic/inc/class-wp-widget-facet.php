<?php
// Creating the widget 
class facet_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'facet', 
			esc_html__('Facet Widget', 'modellic'), 
			array( 'description' => esc_html__( 'Put your filter codes in this widget.', 'modellic' ) ) 
		);
	}

	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', $instance['title'] );

		$widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$text = apply_filters( 'widget_text', $widget_text, $instance, $this );

		echo $args['before_widget'];
			
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			?><div class="facetwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div><?php

		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		//$filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
		$title = sanitize_text_field( $instance['title'] );
		$text = wp_kses_post( stripslashes( $instance['title'] ) );

		?><p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'modellic' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php esc_html_e( 'Content:', 'modellic' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

		<!--p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"></label></p--><?php 

	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		if ( current_user_can('unfiltered_html') ) {
			$instance['text'] =  $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( stripslashes( $new_instance['text'] ) );
		}

		//$instance['filter'] = ! empty( $new_instance['filter'] );

		return $instance;
	}
}

// Register and load the widget
function facet_load_widget() {
	register_widget( 'facet_widget' );
}
add_action( 'widgets_init', 'facet_load_widget' );







// Creating the widget 
class sidebar_button_widget extends WP_Widget {

	function __construct() {

		parent::__construct(
			// Base ID of your widget
			'sidebar_button', 

			// Widget name will appear in UI
			esc_html__('Sidebar Button', 'modellic'), 

			// Widget description
			array( 'description' => esc_html__( 'Button to open the sidebar on mobile.', 'modellic' ) )
		);

	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', $instance['title'] );

		if ( ! empty( $title ) ) {
			echo '<div class="sidebar-button"><a class="modal-trigger waves-effect waves-light btn" href="#sidebar" id="filter-trigger"><span class="icon-filter"></span>' . $title . '</a></div>';
		}

	}
			
	// Widget Backend 
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = sanitize_text_field( $instance['title'] );

		// Widget admin form
		?><p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'modellic' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p><?php

	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;
	}

}

// Register and load the widget
function sidebar_button_load_widget() {
	register_widget( 'sidebar_button_widget' );
}
add_action( 'widgets_init', 'sidebar_button_load_widget' );

