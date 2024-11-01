<?php
/* 
 Plugin Name: Alexa Traffic Rank Widget
 Plugin URI: https://wordpress.org/plugins/alexa-traffic-rank-widget/
 Description: Alexa Traffic Rank Widget is the best WordPress plugin to add alexa ranking widget to your website or blog. It does not require you to provide any login details only enter site url.
 Version: 2.0       
 Author: WebShouters                    
 Author URI: http://www.webshouters.com/          
 License: GPL3                                 
 */                                                                                                                                                                                                     
                                                                                                                                                                                                                                                                                                           
class WS_ALEXA_TRAFFIC_RANK extends WP_Widget {
	                      
	function __construct() {                       
		                                                                             
		parent::__construct(
			'alexa_traffic_rank_widget', // Base ID
			__( 'Alexa Traffic Rank', 'alexa-traffic-rank-widget' ), // Name
			array( 'description' => __( 'Monitor your alexa ranking!', 'alexa-traffic-rank-widget' ), ) // Args
		);
		           
	}                                           
	 
	public function form( $instance ) {  

		$defaults = array( 'title' => __('Alexa Traffic Rank', 'webshouter'), 'website_url' => 'http://www.webshouters.com/', 'layout' => 'horizontal' );
		
        $instance = wp_parse_args( (array) $instance, $defaults ); 

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title','webshouter' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        
        <p>
            <label
                for="<?php echo $this->get_field_id( 'website_url' ); ?>"><?php _e( 'Website/Blog URL','webshouter'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'website_url' ); ?>"
                   name="<?php echo $this->get_field_name( 'website_url' ); ?>" type="text"
                   value="<?php echo esc_attr( $instance['website_url'] ); ?>">
        </p>
		
		<p>
			<label for="<?php echo $this->get_field_id('layout'); ?>"><?php _e('Layout','webshouter'); ?>:</label> 
			<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>" style="width:100%;">
				<option <?php if ('horizontal' == $instance['layout']) echo 'selected="selected"'; ?>>Horizontal</option>
				<option <?php if ('vertical' == $instance['layout']) echo 'selected="selected"'; ?>>Vertical</option>
			</select>
		</p>
		
		<p>
			<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=T59LYJEC5HAHC" target="_blank" title="Donate"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0"  alt="PayPal - The safer, easier way to pay online!" /></a>
		</p>
			

    <?php
    }



public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']              = strip_tags( $new_instance['title'] );
		$instance['layout']      = strip_tags( strtolower($new_instance['layout']));
        $instance['website_url']      = strip_tags( $new_instance['website_url'] );
        return $instance;
    }


public function widget( $args, $instance ) {
        $title              = apply_filters( 'widget_title', $instance['title'] );
        $layout      = $instance['layout'];
        $website_url = $instance['website_url'];
		
        echo $args['before_widget'];
		
        if ( ! empty( $title ) ) {
        	
            echo $args['before_title'] . $title . $args['after_title'];
			
        }
		
		$html='';
		
		if($layout=="horizontal"):	
		    
		    $html .= '<a href="http://www.alexa.com/siteinfo/'.$website_url.'"><script type="text/javascript" language="JavaScript" src="http://xslt.alexa.com/site_stats/js/s/a?url='.$website_url.'"></script></a>';
			
			echo $html;
		
		endif;
		
		if($layout=="vertical"):
		
			$html .= '<a href="http://www.alexa.com/siteinfo/'.$website_url.'"><script type="text/javascript" language="JavaScript" src="http://xslt.alexa.com/site_stats/js/s/b?url='.$website_url.'"></script></a>';
			
			echo $html;
		
		endif;
		
        echo $args['after_widget'];
    }

}

// register widget
function register_ws_alexa_traffic_rank_widget() {
	
    register_widget( 'WS_ALEXA_TRAFFIC_RANK' );
	
}
add_action( 'widgets_init', 'register_ws_alexa_traffic_rank_widget' );




