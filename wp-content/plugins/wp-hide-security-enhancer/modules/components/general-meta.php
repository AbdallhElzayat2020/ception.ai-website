<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WPH_module_general_meta extends WPH_module_component
        {
            function get_component_title()
                {
                    return "Meta";
                }
            
                                    
            function get_module_settings()
                {
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_generator_meta',
                                                                                                                
                                                                    'input_type'    =>  'radio',
                                 
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_other_generator_meta',
                                                                                                                  
                                                                    'input_type'    =>  'radio',
                                                      
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_shortlink_meta',
                                                                                                         
                                                                    'input_type'    =>  'radio',
                                                            
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_dns_prefetch',
                                                                                                                              
                                                                    'input_type'    =>  'radio',
                                                  
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );  
          
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_resource_hints',
                                                                                                                     
                                                                    'input_type'    =>  'radio',
                                                  
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    ); 
          
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_wlwmanifest',
                                            
                                                                    'input_type'    =>  'radio',
                                               
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'disable_json_rest_wphead_link',
                                                                                                                      
                                                                    'input_type'    =>  'radio',
                                                      
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  58
                                                                    
                                                                    );
                    
                    
               
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_rsd_link',
                                                                                                                        
                                                                    'input_type'    =>  'radio',
                                                    
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
           
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_adjacent_posts_rel',
                                                                                                                        
                                                                    'input_type'    =>  'radio',
                                                            
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_profile',
                                                       
                                                                    'input_type'    =>  'radio',
                                               
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_canonical',
                                                                                                                   
                                                                    'input_type'    =>  'radio',
                                                       
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    return $this->module_settings;   
                }
                

        function set_module_components_description( $component_settings )
                {

                    foreach ( $component_settings   as  $component_key  =>  $component_setting )
                        {
                            if ( ! isset ( $component_setting['id'] ) )
                                continue;
                            
                            switch ( $component_setting['id'] )
                                {
                                    case 'remove_generator_meta' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove WordPress Generator Meta',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove the autogenerated meta generator tag within head (WordPress Version).',  'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove WordPress Generator Meta',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("Remove the autogenerated meta generator tag within head (WordPress Version).",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                    "<br />" . __("Tag example:",    'wp-hide-security-enhancer') . "<br />  <br />
                                                                                                                                                                                                    <code>&lt;meta name=&quot;generator&quot; content=&quot;WordPress 5.3.1&quot; /&gt;</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-meta/'
                                                                                                                                                                ),

                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_other_generator_meta' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove Other Generator Meta',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove other meta generated tags within head (eg Theme Name, Theme Version).',  'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove Other Generator Meta',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("Remove other meta generated tags within head (eg Theme Name, Theme Version).",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                    "<br />" . __("Tag example:",    'wp-hide-security-enhancer') . "<br />  <br />
                                                                                                                                                                                                    <code>&lt;meta content=&quot;Divi -  Child v.1.0.0&quot; name=&quot;generator&quot;/&gt;</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-meta/'
                                                                                                                                                                ),
                                                                                                                                    
                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_shortlink_meta' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove Shortlink Meta',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove shortlink tags within head.',  'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_dns_prefetch' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove DNS Prefetch',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove DNS Prefetch meta generated tag.',  'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove DNS Prefetch',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("DNS prefetching allows you to resolve domain names (perform a DNS lookup in the background) before a user clicks on a link, which in turn can help improve performance.",    'wp-hide-security-enhancer'),
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-meta/'
                                                                                                                                                                ),

                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),    
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_resource_hints' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove Resource Hints',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove Resource Hints meta generated tags within head (eg dns-prefetch, preconnect).',  'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove Resource Hints',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("DNS prefetching and preconect allows you to resolve domain names before a user clicks on a link, which in turn can help and slightly improve performance.",    'wp-hide-security-enhancer'),
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-meta/'
                                                                                                                                                                ),
                                                                                                                                    
                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ), 
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_wlwmanifest' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove wlwmanifest Meta',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove the wlwmanifest tag within head.',  'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove wlwmanifest Meta',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("The above link is actually used by Windows Live Writer. If you don't te application, this is just unnecessary code.",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><br/>" . __("Sample tag:",    'wp-hide-security-enhancer') . 
                                                                                                                                                                                                "<br /><code>&lt;link rel=&quot;wlwmanifest&quot; type=&quot;application/wlwmanifest+xml&quot; href=&quot;http://-domain-name-/wp-includes/wlwmanifest.xml&quot; /&gt;</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-meta/'
                                                                                                                                                                ),
                                                                                                                                    
                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'disable_json_rest_wphead_link' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Disable output the REST API link tag into page header',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('By default a REST API link tag is being append to HTML.',    'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Disable output the REST API link tag into page header',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("This option disable the tag output with the JSON API url.",    'wp-hide-security-enhancer') . 
                                                                                                                                                                                                "<br /><br/>" . __("Sample tag:",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><code>&lt;link rel='https://api.w.org/' href='https://-domain-name-/wp-json/' /&gt;</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-meta/'
                                                                                                                                                                ),
                                                                                                                                    
                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_rsd_link' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove rsd_link Meta',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove the rsd_link tag within head.',  'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove rsd_link Meta',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("This helps to hide the link to the Really Simple Discovery service endpoint.",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><br/>" . __("Sample tag:",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><code>&lt;link rel='EditURI' type='application/rsd+xml' title='RSD' href='https://-domain-name-/xmlrpc.php?rsd' /&gt;</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-meta/'
                                                                                                                                                                ),
                                                                                                                                    
                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_adjacent_posts_rel' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove adjacent_posts_rel Meta',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove the adjacent_posts_rel tag within head.',  'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove adjacent_posts_rel Meta',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("This helps to hide the post adjacent tags.",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><br/>" . __("Sample tag:",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><code>&lt;link rel='next' title='Dummy Post' href='http://-domain-name-/dummy-post/' /&gt;</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-meta/'
                                                                                                                                                                ),

                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ), 
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_profile' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove profile link',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove profile link meta tag within head.',  'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove adjacent_posts_rel Meta',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("This helps to hide the profile tags.",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><br/>" . __("Sample tag:",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><code>&lt;link rel='profile' href='http://-domain-name-/profile/' /&gt;</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-meta/'
                                                                                                                                                                ),

                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_canonical' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove canonical link',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove canonical link meta tag within head.',  'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove adjacent_posts_rel Meta',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("The rel=canonical element, often called the 'canonical link', is an HTML element that helps webmasters prevent duplicate content issues. It does this by specifying the 'canonical URL', the 'preferred' version of a web page - the original source, even.",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><br/>" . __("Sample tag:",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><code>&lt;link rel=&quot;canonical&quot; href=&quot;http://-domain-name-/dummy-post/&quot; /&gt;</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-meta/'
                                                                                                                                                                ),

                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),
                                                                                                                                ) );
                                                                break;
                                                     
                                }
                                
                            $component_settings[ $component_key ]   =   $component_setting;
                        }
                    
                    return $component_settings;
                    
                }
                    
                
            function _init_remove_generator_meta($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    add_filter('the_generator',     array( $this, 'the_generator' ));
                    remove_action( 'wp_head',       'wp_generator' ); 
                    
                    //make sure it's being replaced
                    add_filter( 'wp-hide/ob_start_callback',         array(&$this, 'ob_start_callback_remove_generator_meta'));
                }
            
            function the_generator()
                {
                    
                    return '';
                       
                }
            
            
            function ob_start_callback_remove_generator_meta( $buffer )
                {
                    
                    $buffer = preg_replace_callback('/(<meta([^>]+)name=("|\')generator("|\')([^>]+)?\/?>)/im', array($this, "remove_generator_meta_preg_replace_callback"), $buffer);
           
                    return $buffer;
                    
                    
                }
            
            
            function remove_generator_meta_preg_replace_callback( $matches )
                {
                    
                    $found  =   isset($matches[0]) ?    $matches[0] :   '';
                    
                    if(empty($found))
                        return '';
                    
                    //check if content starts with WordPress
                    if(stripos($found, 'content="WordPress ')   !== FALSE)
                        return "";
                    
                    return $found;    
                    
                }
            
            
            function _init_remove_other_generator_meta($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    //remove other generator links
                    add_filter( 'wp-hide/ob_start_callback',         array(&$this, 'ob_start_callback_remove_other_generator_meta'));
                }
            
            
            function ob_start_callback_remove_other_generator_meta( $buffer )
                {
                    
                    $buffer = preg_replace_callback('/(<meta([^>]+)name=("|\')generator("|\')([^>]+)?\/?>)/im', array($this, "remove_other_generator_meta_preg_replace_callback"), $buffer);
           
                    return $buffer;
                    
                }
            
            function remove_other_generator_meta_preg_replace_callback( $matches )
                {
                    $found  =   isset($matches[0]) ?    $matches[0] :   '';
                    
                    if(empty($found))
                        return '';
                    
                    //check if content starts with WordPress
                    if(stripos($found, 'content="WordPress ')   === FALSE)
                        return "";
                    
                    return $found;   
                }
            
            
            function _init_remove_shortlink_meta($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    //remove other generator links
                    add_filter( 'wp-hide/ob_start_callback',         array(&$this, 'ob_start_callback_remove_shortlink_meta'));
                }
            
            function ob_start_callback_remove_shortlink_meta( $buffer )
                {
                    
                    $result   = preg_match_all('/(<link([^>]+)rel=("|\')shortlink("|\')([^>]+)?\/?>)/im', $buffer, $founds);
    
                    if(!isset($founds[0])   ||  count($founds[0])    <   1)
                        return $buffer;
    
                    if(count($founds[0]) > 0)
                        {
                            foreach ($founds[0]  as  $found)
                                {
                                    if(empty($found))
                                        continue;
                                        
                                    $buffer =   str_replace($found, "", $buffer);
                                    
                                }
                            
                        }
                    
                    return $buffer;
                    
                }
            
            function _init_remove_dns_prefetch( $saved_field_data )
                {
                 
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    if( defined('WP_ADMIN') &&  ( !defined('DOING_AJAX') ||  ( defined('DOING_AJAX') && DOING_AJAX === FALSE )) && ! apply_filters('wph/components/force_run_on_admin', FALSE, 'remove_dns_prefetch' ) )
                        return FALSE;
                             
                    add_filter( 'wp-hide/ob_start_callback',         array(&$this, 'ob_start_callback_remove_dns_prefetch')); 
                    
                }
                
            
            function ob_start_callback_remove_dns_prefetch( $buffer )
                {
                    
                    if(is_admin())
                        return $buffer;
                    
                    $result   = preg_match_all('/(<link([^>]+)rel=("|\')dns-prefetch("|\')([^>]+)?\/?>)/im', $buffer, $founds);
    
                    if(!isset($founds[0])   ||  count($founds[0])    <   1)
                        return $buffer;
    
                    if(count($founds[0]) > 0)
                        {
                            foreach ($founds[0]  as  $found)
                                {
                                    if(empty($found))
                                        continue;
                                        
                                    $buffer =   str_replace($found, "", $buffer);
                                    
                                }
                            
                        }
                    
                    return $buffer;    
                    
                }
            
                
            function _init_remove_resource_hints($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action( 'wp_head',             'wp_resource_hints',               2     );     
                    
                }
            
                
            function _init_remove_wlwmanifest($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action( 'wp_head',       'wlwmanifest_link' );     
                    
                }
                
                
            function _init_disable_json_rest_wphead_link($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;

                    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
                    
                }
                
            function _init_remove_rsd_link($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action('wp_head',    'rsd_link');     
                    
                }
                
                
            function _init_remove_adjacent_posts_rel($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action('wp_head',    'adjacent_posts_rel_link_wp_head',  10,     0);     
                    
                }
                
                
            function _init_remove_profile($saved_field_data)
                {
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    if( defined('WP_ADMIN') &&  ( !defined('DOING_AJAX') ||  ( defined('DOING_AJAX') && DOING_AJAX === FALSE )) && ! apply_filters('wph/components/force_run_on_admin', FALSE, 'remove_profile' ) )
                        return FALSE;
                        
                    add_filter('wp-hide/ob_start_callback', array($this, 'remove_profile_tag'));     
                    
                }
                
            function remove_profile_tag( $buffer )
                {
                     
                    if(is_admin())
                        return $buffer;
                    
                    $result   = preg_match_all('/(<link([^>]+)rel=("|\')profile("|\')([^>]+)?\/?>)/im', $buffer, $founds);
    
                    if(!isset($founds[0])   ||  count($founds[0])    <   1)
                        return $buffer;
    
                    if(count($founds[0]) > 0)
                        {
                            foreach ($founds[0]  as  $found)
                                {
                                    if(empty($found))
                                        continue;
                                        
                                    $buffer =   str_replace($found, "", $buffer);
                                    
                                }
                            
                        }
                    
                    return $buffer;
                         
                }
                
                
            function _init_remove_canonical($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    remove_action(  'wp_head', 'rel_canonical');
                                        
                    //use the earlier possible action to remove the admin canonical url
                    add_action( 'auth_redirect',        array(&$this,   'remove_wp_admin_canonical_url'));
                    
                    if( defined('WP_ADMIN') &&  ( !defined('DOING_AJAX') ||  ( defined('DOING_AJAX') && DOING_AJAX === FALSE )) && ! apply_filters('wph/components/force_run_on_admin', FALSE, 'remove_canonical' ) )
                        return FALSE;
                    
                    //make sure is removed if placed by other plugins
                    add_filter('wp-hide/ob_start_callback', array($this, 'remove_canonical_tag'));
                }
            
            function remove_wp_admin_canonical_url()
                {
                    
                    remove_action(  'admin_head', 'wp_admin_canonical_url'   );                    
                    
                }
                
                
            function remove_canonical_tag( $buffer )
                {
                               
                    if(is_admin())
                        return $buffer;
                    
                    $result   = preg_match_all('/(<link([^>]+)rel=("|\')canonical("|\')([^>]+)?\/?>)/im', $buffer, $founds);
    
                    if(!isset($founds[0])   ||  count($founds[0])    <   1)
                        return $buffer;
    
                    if(count($founds[0]) > 0)
                        {
                            foreach ($founds[0]  as  $found)
                                {
                                    if(empty($found))
                                        continue;
                                        
                                    $buffer =   str_replace($found, "", $buffer);
                                    
                                }
                            
                            
                        }
                    
                    return $buffer;
           
                }


        }
        
?>