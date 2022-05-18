<?php 
namespace Shop_Ready\base;

abstract Class Custom_Post{

    /**
     * service initializer
     * @return void
     * @since 1.0
     */
    public function init( $type, $singular_label, $plural_label, $settings = array() ){
        
        $default_settings = array(

            'labels' => array(
                'name'               => esc_html__( $plural_label, 'shopready-elementor-addon' ),
                'singular_name'      => esc_html__( $singular_label, 'shopready-elementor-addon' ),
                'add_new_item'       => esc_html__( 'Add New '.$singular_label, 'shopready-elementor-addon' ),
                'edit_item'          => esc_html__( 'Edit '.$singular_label, 'shopready-elementor-addon' ),
                'new_item'           => esc_html__( 'New '.$singular_label, 'shopready-elementor-addon' ),
                'view_item'          => esc_html__( 'View '.$singular_label, 'shopready-elementor-addon' ),
                'search_items'       => esc_html__( 'Search '.$plural_label, 'shopready-elementor-addon' ),
                'not_found'          => esc_html__( 'No '.$plural_label.' found', 'shopready-elementor-addon' ),
                'not_found_in_trash' => esc_html__( 'No '.$plural_label.' found in trash', 'shopready-elementor-addon' ),
                'parent_item_colon'  => esc_html__( 'Parent '.$singular_label, 'shopready-elementor-addon' ),
                'menu_name'          => esc_html__( $plural_label,'shopready-elementor-addon' )
            ),

            'public'        => true,
            'has_archive'   => true,
            'menu_icon'     => '',
            'menu_position' => 20,
            'supports'      => array(
                'title',
                'editor',
               
            ),
            'rewrite' => array(
                'slug' => sanitize_title_with_dashes($plural_label)
            )
        );

        $this->posts[$type] = array_merge($default_settings, $settings);
    }

    public function register_custom_post(){

        foreach($this->posts as $key => $value) {
            register_post_type($key, $value);
            flush_rewrite_rules( false );
        }

    }
}
