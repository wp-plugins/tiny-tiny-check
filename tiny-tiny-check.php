<?php
/*
Plugin Name: Tiny Tiny Check
Plugin URI: http://mitakas.com/blog/tiny-tiny-check
Description: Show number of unread items in your Tiny Tiny RSS installation.
Version: 0.2
Text-Domain: tiny-tiny-check
Author: Dimitar Dimitrov
Author URI: http://mitakas.com/blog/about
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class Tiny_Tiny_Check extends WP_Widget {

    public function __construct() {
        $widget_ops = array( 'classname' => 'widget_tiny_tiny_check', 'description' => __( 'The number of unread items in your Tiny Tiny RSS installation', 'tiny-tiny-check' ) );
        parent::__construct( 'tiny_tiny_check', __( 'Tiny Tiny Check', 'tiny-tiny-check' ), $widget_ops );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $url = $instance['url'];
        $user = $instance['user'];
        $tiny_tiny_check_before_item = '<ul><li>';
        $tiny_tiny_check_after_item = '</ul></li>';

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        $count = wp_remote_fopen( $url . 'backend.php?op=getUnread&login=' . $user );
        if ( $count ) {
            if ( is_numeric( $count ) ) {
                echo sprintf( '<ul><li><a href="%s" title="%s">%s</a></li></ul>', esc_url( $url ), esc_attr( $title ), esc_attr( $count ) );
            } else if ( $count == "-1;User not found" ) {
                echo $tiny_tiny_check_before_item . __( 'User not found', 'tiny-tiny-check' ) . $tiny_tiny_check_after_item;
            } else {
                echo $tiny_tiny_check_before_item . __( 'Problem connecting, check your configuration', 'tiny-tiny-check' ) . $tiny_tiny_check_after_item;
            }
        } else {
            echo $tiny_tiny_check_before_item . __( 'No unread items', 'tiny-tiny-check' ) . $tiny_tiny_check_after_item;
        }

        echo $after_widget;
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'url' => '' , 'user' => '' ) );

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['url'] = trailingslashit( trim( $new_instance['url'] ) );
        $instance['user'] = trim( $new_instance['user'] );

        return $instance;
    }

    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'url' => '' , 'user' => '' ) );
        $title = strip_tags( $instance['title'] );
        $url = $instance['url'];
        $user = $instance['user'];

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tiny-tiny-check' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'url' );  ?>"><?php _e( 'Tiny Tiny RSS installation:', 'tiny-tiny-check' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo $url; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'user' );  ?>"><?php _e( 'Username:', 'tiny-tiny-check' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" type="text" value="<?php echo $user; ?>" />
        </p>
        <?php
    }

}
add_action( 'widgets_init', function() { register_widget( 'Tiny_Tiny_Check' ); } );
load_plugin_textdomain( 'tiny-tiny-check', false, basename( dirname( __FILE__ ) ) . '/languages' );
