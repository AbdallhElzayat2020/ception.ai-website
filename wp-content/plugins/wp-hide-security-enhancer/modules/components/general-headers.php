<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WPH_module_general_headers extends WPH_module_component
        {
            function get_component_title()
                {
                    return "Headers";
                }
                                    
            function get_module_settings()
                {
                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_header_link',
                                                                                                                          
                                                                    'input_type'    =>  'radio',
                                                       
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  70
                                                                    );
          
                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_x_powered_by',
                                                                                                                 
                                                                    'input_type'    =>  'radio',
                                              
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  70
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_header_server',
                                                                                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  70
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'remove_x_pingback',
                                                                                                                
                                                                    'input_type'    =>  'radio',
                                              
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  70
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
                                    case 'remove_header_link' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove Link Header',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove Link Header being set as default by WordPress which outputs the site JSON url.', 'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove Link Header',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("HTTP header fields are components of the header section of a request and response messages in the Hypertext Transfer Protocol (HTTP). They define the operating parameters of an HTTP transaction.",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                    "<br /><br />" . __("Sample header:",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                    "<br /><code>Link: &lt;http://-domain-name-/wp-json/&gt;; rel=&quot;https://api.w.org/&quot;</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/request-headers/'
                                                                                                                                                                ),
                                                                                                                                    
                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),
                                                                                                                                ) );
                                                                break;
                                    
                                    case 'remove_x_powered_by' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove X-Powered-By Header',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove X-Powered-By Header if set.', 'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove X-Powered-By Header',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("Sample header:",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                    "<br /><code>x-powered-by: 'W3 Total Cache/0.9.5'</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/request-headers/'
                                                                                                                                                                ),

                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ), 
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_header_server' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove Server Header',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove Server Header if set.', 'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove Server Header',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("Sample header:",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                    "<br /><code>server: 'Apache/2.4.1 (Unix)'</code>",
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/request-headers/'
                                                                                                                                                                ),
                                                                                                                                    
                                                                                                                                    'input_type'    =>  'radio',
                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ), 
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'remove_x_pingback' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove X-Pingback Header',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove X-Pingback Header if being set.', 'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove X-Pingback Header',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("Pingback is one of four types of linkback methods for Web authors to request notification when somebody links to one of their documents. This enables authors to keep track of who is linking to, or referring to their articles. Pingback-enabled resources must either use an X-Pingback header or contain a element to the XML-RPC script.",    'wp-hide-security-enhancer'),
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/request-headers/'
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
                
            
            function _init_remove_header_link( $saved_field_data )
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );    
                    
                }
                
                
            function _init_remove_x_powered_by($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
                    
                }
                
            function _callback_saved_remove_x_powered_by($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    //process all headers through the same item, to avoid multiple IfModule lines
                    $headers    =   array();
                    
                    if($this->wph->server_htaccess_config   === TRUE)
                        {
                            $item_option    =   $this->wph->functions->get_module_item_setting('remove_x_powered_by');
                            if ( $item_option   ==  'yes'  )
                                $headers[]  =   'Header unset X-Powered-By';
                            
                            $item_option    =   $this->wph->functions->get_module_item_setting('remove_header_server');
                            if ( $item_option   ==  'yes'  )
                                $headers[]  =   'Header unset Server';
                                
                            $item_option    =   $this->wph->functions->get_module_item_setting('remove_x_pingback');
                            if ( $item_option   ==  'yes'  )
                                $headers[]  =   'Header unset X-Pingback';
                                
                            if ( count ( $headers ) >   0 )
                                {
                                    $processing_response['rewrite'] =   "\n        " . implode ( "\n        ", $headers );
                                    $processing_response['type']    =   'header';
                                }
                        }
                              
                    if($this->wph->server_web_config   === TRUE)
                        {
                                     
                            $processing_response['rewrite'] =   '';
                        }
                                
                    return  $processing_response;   
                }
                
           

        }
?>