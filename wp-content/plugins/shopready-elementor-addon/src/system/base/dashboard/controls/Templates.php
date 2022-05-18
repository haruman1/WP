<?php

namespace Shop_Ready\system\base\dashboard\controls;


class Templates{
  
    public $action_key          = 'shop_ready_templates_options';
    public $option_key          = 'shop_ready_templates';
    public $nonce               = '_shop_ready_templates';
    public $option_switch_key   = 'shop_ready_templates_switch';
    public $request_data        = [];
    public $transform_templates = [];

    public function register(){
        
       add_action( 'admin_post_'.$this->action_key , [ $this,'_ready_templates_options'] ); 
      
    }
  
    function _ready_templates_options(){
      
        // Verify if the nonce is valid
        if ( !isset($_POST[$this->nonce]) || !wp_verify_nonce( $_POST[ $this->nonce ], $this->action_key) ) {
            wp_redirect($_SERVER[ 'HTTP_REFERER' ]);
        }
       
        if( !array_key_exists($this->option_key,$_POST) ){
           
            wp_redirect( $_SERVER[ 'HTTP_REFERER' ] ); 
            return;
        }
        //sanitize here for array data
   
        $this->request_data = array_map( 'sanitize_text_field', $_REQUEST[$this->option_key] );
        $this->transform_templates_options();
        $this->transform_templates_switch_options();
        
        $this->_parsist();
       
        if ( wp_doing_ajax() ){
  
            wp_die();
        }else{

            $url        = $_SERVER["HTTP_REFERER"];
            $return_url = add_query_arg( array(
                'nav' => $this->option_key,
            ), $url );
    
            wp_redirect($return_url);
        }
        
    } 

    function transform_templates_options(){
 
        $new_array = [];
       
        $templates = shop_templates_config()->all();
       
        foreach( $templates as $key => $item ){

            if( isset($this->request_data[ $key ] ) && is_numeric($this->request_data[ $key ] ) ){
              
                $item['id'] = $this->request_data[ $key ];
            }else{
                $item['id'] = '';
            }
            
           $new_array[$key] = $item;
        }
       
        $this->transform_templates['templates'] = $new_array; 
       
        unset( $new_array );
        unset( $templates );
        unset( $user_data );

    }

   

    public function transform_templates_switch_options(){

        $new_array = [];
         // check switch key exist
         $user_data = [];
        if( isset( $_REQUEST[ $this->option_switch_key ] ) ){
            // sanitize here
    
            $user_data = array_map( 'sanitize_text_field', $_REQUEST[ $this->option_switch_key ]);
        }

        if( is_array( $this->transform_templates ) ){
          
            foreach( $this->transform_templates['templates'] as $key => $item ){
               
                if( isset( $user_data[ $key ] ) ){
                    $item['active'] = 1;
                }else{
                    $item['active'] = 0;
                }
                
               $new_array[$key] = $item;
            }
        }
       
        $this->transform_templates['templates'] = $new_array; 
     
    }

    public function _parsist(){
        
        update_option($this->option_key , wc_clean( $this->transform_templates['templates'] ) );
       
    }
  
}