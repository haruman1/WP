<?php 
namespace Element_Ready\Base\Controls\List_Post;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Custom_Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Element_Ready\Base\BaseController;

class Generel_Grid_Controls extends BaseController
{
	public function register() 
	{
	
		add_action('element_ready_section_general_list_grid_tab' , array( $this, 'settings_section' ), 10, 2 );
		add_action('element_ready_section_general_list_grid_tab_extra_control' , array( $this, 'settings_section_extra' ),10, 2 );
	}
    public function not_allowed_control($control,$widget){
       
        $widget_list = [
           'element_ready-post-slider' =>
                 [ 'show_date','show_cat','show_readmore' ]
       ];
        try{
            if(isset($widget_list[$widget])){

                $the_widget = $widget_list[$widget];
                if( in_array($control,$the_widget) ){
                  return false;
                }else{
                    return true;
                }
            }
           
            return true;
        }catch (Exception $e) {
            return true;
        }
        return true;
    }
	public function settings_section( $ele,$widget ) 
	{
            
           $ele->start_controls_section(
            'section_general_tab',
                [
                    'label' => esc_html__('General', 'element-ready'),
                ]
            );
                $ele->add_control(
                'post_count',
                    [
                        'label'         => esc_html__( 'Post count', 'element-ready' ),
                        'type'          => Controls_Manager::NUMBER,
                        'default'       => '8',
                    ]
                );

                $ele->add_control(
                'post_title_crop',
                    [
                        'label'         => esc_html__( 'Post title crop', 'element-ready' ),
                        'type'          => Controls_Manager::NUMBER,
                        'default'       => '8',
                    ]
                );
                // uncommon  
            
                    $ele->add_control(
                        'show_content',
                        [
                            'label'     => esc_html__('Show content', 'element-ready'),
                            'type'      => Controls_Manager::SWITCHER,
                            'label_on'  => esc_html__('Yes', 'element-ready'),
                            'label_off' => esc_html__('No', 'element-ready'),
                            'default'   => 'yes',
                            'condition' => [ 'block_style' => ['style1','style2','style4','style5','style6'] ]
                        ]
                    );
    
                
              
                    $ele->add_control(
                        'post_content_crop',
                            [
                                'label'         => esc_html__( 'Post content crop', 'element-ready' ),
                                'type'          => Controls_Manager::NUMBER,
                                'default'       => '18',
                                'condition' => [ 'block_style' => ['style1','style2','style4','style5','style6'] ]
                            ]
                    );
                
               
                    $ele->add_control(
                        'show_date',
                        [
                            'label'     => esc_html__('Show Date', 'element-ready'),
                            'type'      => Controls_Manager::SWITCHER,
                            'label_on'  => esc_html__('Yes', 'element-ready'),
                            'label_off' => esc_html__('No', 'element-ready'),
                            'default'   => 'yes',
                            'condition' => [ 'block_style' => ['style2','style1','style4','style5','style6'] ]
                        ]
                    );
                

                
                    $ele->add_control(
                        'show_cat',
                        [
                            'label'     => esc_html__('Show Category', 'element-ready'),
                            'type'      => Controls_Manager::SWITCHER,
                            'label_on'  => esc_html__('Yes', 'element-ready'),
                            'label_off' => esc_html__('No', 'element-ready'),
                            'default'   => 'yes',
                            'condition' => [ 'block_style' => ['style2','style3'] ]
                        ]
                    );
                
             
                    $ele->add_control(
                        'show_author',
                        [
                            'label'     => esc_html__('Show Author', 'element-ready'),
                            'type'      => Controls_Manager::SWITCHER,
                            'label_on'  => esc_html__('Yes', 'element-ready'),
                            'label_off' => esc_html__('No', 'element-ready'),
                            'default'   => 'yes',
                            'condition' => [ 'block_style' => ['style2','style3'] ]
                        ]
                    );
              
               
                    $ele->add_control(
                        'show_author_img',
                        [
                            'label'     => esc_html__('Show Author image', 'element-ready'),
                            'type'      => Controls_Manager::SWITCHER,
                            'label_on'  => esc_html__('Yes', 'element-ready'),
                            'label_off' => esc_html__('No', 'element-ready'),
                            'default'   => 'no',
                            'condition' => [ 'block_style' => ['style2'] ]
                        ]
                    );
            
            
                    $ele->add_control(
                        'show_readmore',
                        [
                            'label'     => esc_html__('Show Readmore', 'element-ready'),
                            'type'      => Controls_Manager::SWITCHER,
                            'label_on'  => esc_html__('Yes', 'element-ready'),
                            'label_off' => esc_html__('No', 'element-ready'),
                            'default'   => 'no',
                            'condition' => [ 'block_style' => ['style'] ]
                        ]
                    );

                    $ele->add_control(
                        'readmore_text',
                        [
                            
                        'label'         => esc_html__( 'Readmore title', 'element-ready' ),
                        'type'          => Controls_Manager::TEXT,
                        'default'      => esc_html__( 'Read more', 'element-ready' ),  
                        'condition' => [ 'show_readmore' => 'yes' ]
                        ]
                     );
                
               
                
                    $ele->add_control(
                        'show_view_count',
                        [
                            'label'     => esc_html__('Show view Count', 'element-ready'),
                            'type'      => Controls_Manager::SWITCHER,
                            'label_on'  => esc_html__('Yes', 'element-ready'),
                            'label_off' => esc_html__('No', 'element-ready'),
                            'default'   => 'yes',
                            'condition' => [ 'block_style' => ['style1','stye2','style3','style4','style5','style6'] ]
                        ]
                    );
                    $ele->add_control(
                        'show_share',
                        [
                            'label'     => esc_html__('Show fb share', 'element-ready'),
                            'type'      => Controls_Manager::SWITCHER,
                            'label_on'  => esc_html__('Yes', 'element-ready'),
                            'label_off' => esc_html__('No', 'element-ready'),
                            'default'   => 'yes',
                            'condition' => [ 'block_style' => ['style1','style3','style4','style5','style6'] ]
                        ]
                    );
                    $ele->add_control(
                        'show_reaction',
                        [
                            'label'     => esc_html__('Show fb reaction', 'element-ready'),
                            'type'      => Controls_Manager::SWITCHER,
                            'label_on'  => esc_html__('Yes', 'element-ready'),
                            'label_off' => esc_html__('No', 'element-ready'),
                            'default'   => 'yes',
                            'condition' => [ 'block_style' => ['style1','style2','style3','style4','style5','style6'] ]
                        ]
                    );
                
                $ele->add_control(
                    'show_trand_icon',
                    [
                        'label'     => esc_html__('Show tranding icon', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => 'no',
                        'condition' => [ 'block_style' => ['style55'] ]
                        
                    ]
                );
                
                do_action( 'element_ready_section_general_list_grid_tab_extra_control', $ele, $widget );
            $ele->end_controls_section();	
    }
    
    public function settings_section_extra($ele, $widget ){
        
          $ele->add_control(
            'loadmore_show',
            [
                'label'     => esc_html__('Show Loadmore', 'element-ready'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__('Yes', 'element-ready'),
                'label_off' => esc_html__('No', 'element-ready'),
                'default'   => 'no',
                'condition' => [ 'block_style' => ['style1','style2','style4'] ]
                
            ]
        );
        $ele->add_control(
            'loadmore_text',
            [
                
                'label'         => esc_html__( 'Loadmore text', 'element-ready' ),
                'type'          => Controls_Manager::TEXT,
                'default'      => esc_html__( 'Load more', 'element-ready' ),  
                'condition' => [ 'block_style' => ['style1','style2','style4'] ,'loadmore_show' => 'yes']
            ]
         );

         $ele->add_control(
            'loadmore_link',
            [
                
            'label'         => esc_html__( 'Loadmore link', 'element-ready' ),
            'type'          => Controls_Manager::TEXT,
            'default'      => '#',  
            'condition' => [ 'block_style' => ['style1','style2','style4'] ,'loadmore_show' => 'yes']
            ]
         );
    }
}