<?php

namespace Element_Ready\Document;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;
use Elementor\Core\Base\Document;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/* 
* Site Global Settings
* @since 1.0 
*/

class Global_Settings extends Tab_Base {

	public function get_id() {
		return 'elements-ready-basic';
	}

	public function get_title() {
		return esc_html__( 'ElementsReady', 'element-ready' );
	}

	public function get_group() {
		return 'settings';
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_help_url() {
		return 'quomodosoft.com';
	}

	protected function register_tab_controls() {
       
        do_action('elements_ready_global_settings_start', $this, $this->get_id());
        do_action('elements_ready_before_newslatter_popup', $this, $this->get_id());
        do_action('elements_ready_newslatter_popup', $this, $this->get_id());
        do_action('elements_ready_global_settings_end', $this, $this->get_id());
			
	}

	/**
	 * Should check for the current action to avoid infinite loop
	 * 
	*/
    public function on_save( $data ) {
       
		if (
			! isset( $data['settings'])
		) {
			return;
		}

        $grid_style = 'elements_products_archive_shop_grid_style';

        if( isset( $data[ 'settings' ][ $grid_style ] ) ){
          
           update_option($grid_style,$data['settings'][$grid_style]);
        }
     
	}

    public function get_additional_tab_content(){

        // use this for notice 
        // as a helper link
        // docs 
        return sprintf( '
				<div class="element-ready-account-module elementor-nerd-box">
                <a class="elementor-button elementor-button-success elementor-nerd-box-link" target="_blank" href="#"> Settings Module </a>
				</div>
				'

			);
    }
 
}
