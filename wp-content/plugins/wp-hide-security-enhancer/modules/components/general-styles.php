<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WPH_module_general_styles extends WPH_module_component
        {
            function get_component_title()
                {
                    return "Styles";
                }
                                    
            function get_module_settings()
                {
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'styles_remove_version',
                                                
                                                                    'input_type'    =>  'radio',
                                                
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower')
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'styles_remove_id_attribute',
                                                                                                                        
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
                                    case 'styles_remove_version' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove Version',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove version number from enqueued style files.', 'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove Version',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("This provide a method to remove the Style file version number which is being append at the end of every style tag. Generally this is intended to be a plain information upon the style code version, however not being used within any functionality or code run.",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                "<br /><br />" . __("Keeping version number for styles provide additional information to hackers which try to identify specific code and version which know as being vulnerable.",    'wp-hide-security-enhancer'),
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-styles/'
                                                                                                                                                                ),

                                                                                                                                    'options'       =>  array(
                                                                                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                                ),
                                                                                                                                ) );
                                                                break;
                                                                
                                    case 'styles_remove_id_attribute' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                    'label'         =>  __('Remove ID from link tags',    'wp-hide-security-enhancer'),
                                                                                                                                    'description'   =>  __('Remove ID attribute from all link tags which include a stylesheet.', 'wp-hide-security-enhancer'),
                                                                                                                                    
                                                                                                                                    'help'          =>  array(
                                                                                                                                                                'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Remove ID from link tags',    'wp-hide-security-enhancer'),
                                                                                                                                                                'description'               =>  __("This provide a method to remove the Style file ID attribute which generally has no usage.",    'wp-hide-security-enhancer'),
                                                                                                                                                                'option_documentation_url'  =>  'https://wp-hide.com/documentation/general-html-styles/'
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
                    
                
            function _init_styles_remove_version($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    if( defined('WP_ADMIN') &&  ( !defined('DOING_AJAX') ||  ( defined('DOING_AJAX') && DOING_AJAX === FALSE )) && ! apply_filters('wph/components/force_run_on_admin', FALSE, 'styles_remove_version' ) )
                        return FALSE;
                             
                    add_filter( 'style_loader_src',         array(&$this, 'remove_file_version'), 999 );
                    
                }
                
            function remove_file_version($src)
                {
                    if( empty($src) )   
                        return $src;
                        
                    $parse_url  =   parse_url( $src );
                    
                    if(empty($parse_url['query']))
                        return $src;
                    
                    parse_str( $parse_url['query'], $query );
                    
                    if(!isset( $query['ver'] ))
                        return $src;
                    
                    unset($query['ver']);    
                    
                    $parse_url['query'] =   http_build_query( $query );
                    if(empty($parse_url['query']))
                        unset( $parse_url['query'] );
                    
                    $url    =   $this->wph->functions->build_parsed_url( $parse_url );
                    
                    return $url;
                    
                }
                
                
            function _init_styles_remove_id_attribute($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    if( defined('WP_ADMIN') &&  ( !defined('DOING_AJAX') ||  ( defined('DOING_AJAX') && DOING_AJAX === FALSE )) && ! apply_filters('wph/components/force_run_on_admin', FALSE, 'styles_remove_id_attribute' ) )
                        return FALSE;
                        
                    add_filter( 'wp-hide/ob_start_callback',         array(&$this, 'ob_start_callback_remove_id'));
                    
                }
                
            
            /**
            * Replace all ID's attribute for link tags
            * 
            * @param mixed $buffer
            */
            function ob_start_callback_remove_id( $buffer )
                {
                    
                    $result   = preg_match_all('/(<link([^>]+)rel=("|\')stylesheet("|\')([^>]+)?\/?>)/im', $buffer, $founds);
    
                    if(!isset($founds[0])   ||  count($founds[0])    <   1)
                        return $buffer;
    
                    if(count($founds[0]) > 0)
                        {
                            foreach ($founds[0]  as  $found)
                                {
                                    if(empty($found))
                                        continue;
                                        
                                    $found_replacement  =   preg_replace( '/(id=("|\')(.*?)("|\') )/i', "", $found );
                                    $buffer =   str_replace($found, $found_replacement, $buffer);
                                    
                                }
                            
                            
                        }
                    
                    return $buffer;
                       
                }
 

        }
?>