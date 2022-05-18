<?php
// Creating the widget 
class jupiter_social_menu extends WP_Widget {    
    function __construct() {        
        parent::__construct( 
            // Base ID of your widget
            'jupiter_social_menu',
            // Widget name will appear in UI
            __('Social Profile', 'jupitercore'), 
            // Widget description
            array( 'description' => __( 'To set your social profile link.', 'jupitercore' ), ) 
        );
    }
    
    // Creating widget front-end 
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $social_facebook = ! empty( $instance['social_facebook'] ) ? $instance['social_facebook'] : '';
        $social_twitter = ! empty( $instance['social_twitter'] ) ? $instance['social_twitter'] : '';
        $social_linkedin = ! empty( $instance['social_linkedin'] ) ? $instance['social_linkedin'] : '';
        $social_google = ! empty( $instance['social_google'] ) ? $instance['social_google'] : '';
        $social_youtube = ! empty( $instance['social_youtube'] ) ? $instance['social_youtube'] : '';
        $social_behance = ! empty( $instance['social_behance'] ) ? $instance['social_behance'] : '';
        $social_dribbble = ! empty( $instance['social_dribbble'] ) ? $instance['social_dribbble'] : '';        
        $data = array();
        $data[] = $args['before_widget'];    
        
        $data[] = ( !empty($title) ? $args['before_title'] . $title  . $args['after_title'] : '' );   
        
        
        $data[] = '<div class="widget-social-menu">';
        $data[] = ( !empty($social_facebook) ? '<a href="'.esc_url($social_facebook).'"><i class="fab fa-facebook-f"></i></a>' : '' );        
        $data[] = ( !empty($social_twitter) ? '<a href="'.esc_url($social_twitter).'"><i class="fab fa-twitter"></i></a>' : '' );
        $data[] = ( !empty($social_linkedin) ? '<a href="'.esc_url($social_linkedin).'"><i class="fab fa-linkedin-in"></i></a>' : '' );
        $data[] = ( !empty($social_google) ? '<a href="'.esc_url($social_google).'"><i class="fab fa-google-plus-g"></i></a>' : '' );
        $data[] = ( !empty($social_youtube) ? '<a href="'.esc_url($social_youtube).'"><i class="fab fa-youtube"></i></a>' : '' );
        $data[] = ( !empty($social_behance) ? '<a href="'.esc_url($social_behance).'"><i class="fab fa-behance"></i></a>' : '' );
        $data[] = ( !empty($social_dribbble) ? '<a href="'.esc_url($social_dribbble).'"><i class="fab fa-dribbble"></i></a>' : '' );        
        $data[] = '</div>';
        
        
        $data[] = $args['after_widget'];        
        $data = implode( '', $data );       
        echo $data;
    }
    
    // Widget Backend 
    public function form( $instance ) {
        $title = (isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );        
        $social_facebook = ! empty( $instance['social_facebook'] ) ? $instance['social_facebook'] : '';
        $social_twitter = ! empty( $instance['social_twitter'] ) ? $instance['social_twitter'] : '';
        $social_linkedin = ! empty( $instance['social_linkedin'] ) ? $instance['social_linkedin'] : '';
        $social_google = ! empty( $instance['social_google'] ) ? $instance['social_google'] : '';
        $social_youtube = ! empty( $instance['social_youtube'] ) ? $instance['social_youtube'] : '';
        $social_behance = ! empty( $instance['social_behance'] ) ? $instance['social_behance'] : '';
        $social_dribbble = ! empty( $instance['social_dribbble'] ) ? $instance['social_dribbble'] : '';
        // Widget admin form
        ?><div class="media-widget-control">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                    <?php esc_html_e( 'Title:','jupitercore' ); ?></label>
                <input class="widefat title" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>  
            <p>
                <label for="<?php echo $this->get_field_id('social_facebook'); ?>"><?php esc_html_e( 'Facebook URL','jupitercore' ); ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('social_facebook'); ?>" id="<?php echo $this->get_field_id('social_facebook'); ?>" value="<?php echo esc_attr($social_facebook); ?>" >
            </p> 
            <p>
                <label for="<?php echo $this->get_field_id('social_twitter'); ?>"><?php esc_html_e( 'Twitter URL','jupitercore' ); ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('social_twitter'); ?>" id="<?php echo $this->get_field_id('social_twitter'); ?>" value="<?php echo esc_attr($social_twitter); ?>" >
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('social_linkedin'); ?>"><?php esc_html_e( 'Linkedin URL','jupitercore' ); ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('social_linkedin'); ?>" id="<?php echo $this->get_field_id('social_linkedin'); ?>" value="<?php echo esc_attr($social_linkedin); ?>" >
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('social_google'); ?>"><?php esc_html_e( 'Google URL','jupitercore' ); ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('social_google'); ?>" id="<?php echo $this->get_field_id('social_google'); ?>" value="<?php echo esc_attr($social_google); ?>" >
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('social_youtube'); ?>"><?php esc_html_e( 'Youtube URL','jupitercore' ); ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('social_youtube'); ?>" id="<?php echo $this->get_field_id('social_youtube'); ?>" value="<?php echo esc_attr($social_youtube); ?>" >
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('social_behance'); ?>"><?php esc_html_e( 'Behance URL','jupitercore' ); ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('social_behance'); ?>" id="<?php echo $this->get_field_id('social_behance'); ?>" value="<?php echo esc_attr($social_behance); ?>" >
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('social_dribbble'); ?>"><?php esc_html_e( 'Dribbble URL','jupitercore' ); ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('social_dribbble'); ?>" id="<?php echo $this->get_field_id('social_dribbble'); ?>" value="<?php echo esc_attr($social_dribbble); ?>" >
            </p>
        </div><?php 
    } 
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {        
        $instance = array();        
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['social_facebook'] = ! empty( $new_instance['social_facebook'] ) ? $new_instance['social_facebook'] : '';
        $instance['social_twitter'] = ! empty( $new_instance['social_twitter'] ) ? $new_instance['social_twitter'] : '';
        $instance['social_linkedin'] = ! empty( $new_instance['social_linkedin'] ) ? $new_instance['social_linkedin'] : '';
        $instance['social_google'] = ! empty( $new_instance['social_google'] ) ? $new_instance['social_google'] : '';
        $instance['social_youtube'] = ! empty( $new_instance['social_youtube'] ) ? $new_instance['social_youtube'] : '';
        $instance['social_behance'] = ! empty( $new_instance['social_behance'] ) ? $new_instance['social_behance'] : '';
        $instance['social_dribbble'] = ! empty( $new_instance['social_dribbble'] ) ? $new_instance['social_dribbble'] : '';        
        return $instance;
    }
}