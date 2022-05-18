<?php

    add_action( 'cmb2_admin_init', 'jupiter_register_post_metabox' );    
    function jupiter_register_post_metabox() {        
        $prefix = '_jupi_';
     
        /*-- Page-Meta-Box-Fields --*/
        $jupiter_portfolio_meta = new_cmb2_box(array(
            'id'            => $prefix . 'portfolio_meta_options',
            'title'         => esc_html__('Portfolio Options', 'jupitercore' ),
            'object_types'  => array( 'portfolio' )
        ));  
        
        
        $jupiter_portfolio_meta->add_field(array(
            'name'    => esc_html__('Project Type', 'jupitercore' ),
            'id'      => $prefix . 'project_type',
            'type'    => 'text',
            'desc' => esc_html__('What is the project type. Example: ( Design, Development ) Etc.', 'jupitercore' )
        ));
        
        
        $jupiter_portfolio_meta->add_field(array(
            'name'    => esc_html__('Date', 'jupitercore' ),
            'id'      => $prefix . 'project_date',
            'type'    => 'text_date',
            'desc' => esc_html__('When did you start the project?', 'jupitercore' )
        ));
        
        $jupiter_portfolio_meta->add_field(array(
            'name'    => esc_html__('Client Name', 'jupitercore' ),
            'id'      => $prefix . 'client_name',
            'type'    => 'text',
            'desc' => esc_html__('What is your client name. Please type here.', 'jupitercore' )
        ));
        
        $jupiter_portfolio_meta->add_field(array(
            'name'    => esc_html__('Tools Name', 'jupitercore' ),
            'id'      => $prefix . 'tools_name',
            'type'    => 'text',
            'desc' => esc_html__('What tools have you used?', 'jupitercore' )
        ));    
        $jupiter_portfolio_meta->add_field(array(
            'name'    => esc_html__('Project URL', 'jupitercore' ),
            'id'      => $prefix . 'project_url',
            'type'    => 'text_url',
            'desc' => esc_html__('Do you have any live demo link? Please type here.', 'jupitercore' )
        ));
             
        /*-- Page-Meta-Box-Fields --*/
        $jupiter_page_meta = new_cmb2_box(array(
            'id'            => $prefix . 'page_options',
            'title'         => esc_html__('Page Options', 'jupitercore' ),
            'object_types'  => array( 'page' )
        ));  
        
        
        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Onepage Template:', 'jupitercore' ),
            'id'      => $prefix . 'one_page_template',
            'type'    => 'checkbox',
            'desc' => esc_html__('Will this page use as a onepage template?', 'jupitercore' )
        ));
        
        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Onepage Scroll', 'jupitercore' ),
            'id'      => $prefix . 'one_page_scroll',
            'type'    => 'checkbox',
            'desc' => esc_html__('To get a id selected scroll?', 'jupitercore' )
        ));
        
        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Remove Page Header:', 'jupitercore' ),
            'id'      => $prefix . 'page_header',
            'type'    => 'checkbox',
            'desc' => esc_html__('Check this field if you want remove page header on this page.', 'jupitercore' )
        ));
        
        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Transparent Menu:', 'jupitercore' ),
            'id'      => $prefix . 'transparent_menu',
            'type'    => 'checkbox',
            'desc' => esc_html__('Check this field if you want transparent menu on this page.', 'jupitercore' )
        ));
       $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Remove Footer Area:', 'jupitercore' ),
            'id'      => $prefix . 'footer_widget',
            'type'    => 'checkbox',
            'desc' => esc_html__('Check this field if you want remove footer widgets on this page.', 'jupitercore' )
        )); 

        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Menu Text Color', 'jupitercore' ),
            'id'      => $prefix . 'mtc',
            'type'    => 'colorpicker',
            'options' => array(
                'alpha' => true, // Make this a rgba color picker.
            ),
        ));
        
        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Menu Hover Text Color', 'jupitercore' ),
            'id'      => $prefix . 'mhtc',
            'type'    => 'colorpicker',
            'options' => array(
                'alpha' => true, // Make this a rgba color picker.
            ),
        ));  
        
        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Menu Bar Color', 'jupitercore' ),
            'id'      => $prefix . 'miabc',
            'type'    => 'colorpicker',
            'options' => array(
                'alpha' => true, // Make this a rgba color picker.
            ),
        ));        
        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Menu Plus Color', 'jupitercore' ),
            'id'      => $prefix . 'mipc',
            'type'    => 'colorpicker',
            'options' => array(
                'alpha' => true, // Make this a rgba color picker.
            ),
        ));


        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Sticy Menu Text Color', 'jupitercore' ),
            'id'      => $prefix . 'smtc',
            'type'    => 'colorpicker',
            'options' => array(
                'alpha' => true, // Make this a rgba color picker.
            ),
        ));
        
        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Sticky Menu Hover Text Color', 'jupitercore' ),
            'id'      => $prefix . 'smhtc',
            'type'    => 'colorpicker',
            'options' => array(
                'alpha' => true, // Make this a rgba color picker.
            ),
        ));  
        
        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Sticky Menu Bar Color', 'jupitercore' ),
            'id'      => $prefix . 'smiabc',
            'type'    => 'colorpicker',
            'options' => array(
                'alpha' => true, // Make this a rgba color picker.
            ),
        ));        
        $jupiter_page_meta->add_field(array(
            'name'    => esc_html__('Sticky Menu Plus Color', 'jupitercore' ),
            'id'      => $prefix . 'smipc',
            'type'    => 'colorpicker',
            'options' => array(
                'alpha' => true, // Make this a rgba color picker.
            ),
        ));

    
                
        /*-- Post-Meta-Box-Content --*/
        $jupiter_post_meta = new_cmb2_box( array(
            'id'           => $prefix.'post_metabox',
            'title'        => esc_html__('Additional Fields', 'jupitercore' ),
            'object_types' => array( 'post' ), // post type
        ) );
        
        $jupiter_post_meta->add_field( array(
                'name'       => esc_html__( 'Photo Gallery',  'jupitercore'  ),
                'desc'       => esc_html__( 'This field for gallery images. This gallery show for select gallery format.',  'jupitercore'  ),
                'id'         => $prefix . 'post_gallery',
                'type'       => 'file_list',
                'text' => array(
                    'add_upload_files_text' => esc_html__('Add images', 'jupitercore' ), // default: "Add or Upload Files"
                ),
            )
        );
        
        $jupiter_post_meta->add_field( array(
            'name' => esc_html__('Embed Video', 'jupitercore' ),
            'desc' => esc_html__('Enter a youtube, twitter, or instagram URL. Supports services listed at ', 'jupitercore' ).'<a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a> '.esc_html__('This video show for select video format', 'jupitercore' ),
            'id'   => $prefix . 'post_video_embed',
            'type' => 'oembed',
        ) );
        
        $jupiter_post_meta->add_field( array(
            'name' => esc_html__('Embed Audio', 'jupitercore' ),
            'desc' => esc_html__('Enter a SoundCloud, Mixcloud, or ReverbNation etc URL. Supports services listed at ', 'jupitercore' ).'<a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a> '.esc_html__('This audio show for select audio format', 'jupitercore' ),
            'id'   => $prefix . 'post_audio_embed',
            'type' => 'oembed',
        ) );

    }
    
    if( !function_exists("jupiter_gallery_photo_list") ){
      function jupiter_gallery_photo_list( $gallery_images, $img_size = 'jupiter_blog_thumb' ) {
          if( empty($gallery_images) ){
              return false;
          }
            // Get the list of gallery
            $data = '<div class="photo-slider post-media">';
            // Loop through them and output an image
            foreach ( (array) $gallery_images[0] as $image_id => $image_url ) {
                $data .= '<div class="gallery-item" >';
                $data .= wp_get_attachment_image( $image_id, $img_size );
                $data .= '</div>';
            }
            $data .= '</div>';
          return $data;
        }
    }
    
    if( !function_exists('jupiter_video_embed_content') ){
        function jupiter_video_embed_content($post_video_embed_url){
            if( empty($post_video_embed_url) ){
                return false;
            }
            ob_start();
            ?>
            <div class="post-media video-post">
                <button type="button" class="video-play-bttn"><i class="fa fa-play"></i></button>
                <?php $video_url = wp_oembed_get( esc_url($post_video_embed_url) );
                    echo str_replace( 'src','data-src', $video_url );
                ?>
                <div class="videoPoster" style="background-image: url('<?php echo get_the_post_thumbnail_url('','full'); ?>');"></div>
            </div>
            <?php 
            $data = ob_get_contents();
            ob_end_clean();
            return $data;
        }
    }
    
    if( !function_exists('jupiter_audio_embed_content') ){
        function jupiter_audio_embed_content($post_audio_embed_url){
            if( empty($post_audio_embed_url) ){
                return false;
            }
            return '<div class="post-media audio-post">'.wp_oembed_get( $post_audio_embed_url ).'</div>';
        }
    }    
    if(!function_exists('jupiter_admin_print_script')){
       function jupiter_admin_print_script(){
            if( get_post_type() == 'post' ): ?>
<script type="text/javascript">
    (function($) {
        "use strict";
        $(document).on('ready', function() {
            $('.cmb2-postbox .cmb-row').css({
                'border-bottom': 'none',
                'margin-bottom': '0'
            });
            $('#_jupiter_post_metabox').hide(0);
            $('.cmb2-id--jupiter-post-gallery').hide(0);
            $('.cmb2-id--jupiter-post-video-embed').hide(0);
            $('.cmb2-id--jupiter-post-audio-embed').hide(0);

            var id = $('input[name="post_format"]:checked').attr('id');

            if (id == 'post-format-gallery') {
                $('#_jupiter_post_metabox').show(0);
                $('.cmb2-id--jupiter-post-gallery').show();
            } else {
                $('.cmb2-id--jupiter-post-gallery').hide();
            }
            if (id == 'post-format-video') {
                $('#_jupiter_post_metabox').show(0);
                $('.cmb2-id--jupiter-post-video-embed').show();
            } else {
                $('.cmb2-id--jupiter-post-video-embed').hide();
            }
            if (id == 'post-format-audio') {
                $('#_jupiter_post_metabox').show(0);
                $('.cmb2-id--jupiter-post-audio-embed').show();
            } else {
                $('.cmb2-id--jupiter-post-audio-embed').hide();
            }
            $('#post-formats-select .post-format').on('change', function() {
                $('#_jupiter_post_metabox').hide(0);
                $('.cmb2-id--jupiter-post-gallery').hide(0);
                $('.cmb2-id--jupiter-post-video-embed').hide(0);
                $('.cmb2-id--jupiter-post-audio-embed').hide(0);
                var id = $('input[name="post_format"]:checked').attr('id');
                if (id == 'post-format-gallery') {
                    $('#_jupiter_post_metabox').show(0);
                    $('.cmb2-id--jupiter-post-gallery').show();
                } else {
                    $('.cmb2-id--jupiter-post-gallery').hide();
                }
                if (id == 'post-format-video') {
                    $('#_jupiter_post_metabox').show(0);
                    $('.cmb2-id--jupiter-post-video-embed').show();
                } else {
                    $('.cmb2-id--jupiter-post-video-embed').hide();
                }
                if (id == 'post-format-audio') {
                    $('#_jupiter_post_metabox').show(0);
                    $('.cmb2-id--jupiter-post-audio-embed').show();
                } else {
                    $('.cmb2-id--jupiter-post-audio-embed').hide();
                }
            });
        });
    }(jQuery));
</script>
<?php endif; 
       } 
    }
add_action( 'admin_print_scripts', 'jupiter_admin_print_script',1000 );
