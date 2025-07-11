<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WPH_module_component_login_2fa_app extends WPH_module_component
        {            
            function get_component_title()
                {
                    return "2FA - Auth App";
                }
                                        
            function get_module_settings()
                {
                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  '2fa_app',
                                                                                                                          
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
                                    case '2fa_app' :
                                                                $component_setting =   array_merge ( $component_setting , array(
                                                                                                                                'label'         =>  __('Activate Authenticator app (TOTP)',    'wp-hide-security-enhancer'),
                                                                                                                                'description'   =>   __('Authenticator App (Google Authenticator, Microsoft Authenticator, and Similar Apps)', 'wp-hide-security-enhancer'),
                                                                                                                                
                                                                                                                                'help'          =>  array(
                                                                                                                                                                    'title'                     =>  __('Help',    'wp-hide-security-enhancer') . ' - ' . __('Activate Authenticator app (TOTP)',    'wp-hide-security-enhancer'),
                                                                                                                                                                    'description'               =>  "<b>" . __('Enhance your account security with an Authenticator App that generates time-based one-time passcodes for Two-Factor Authentication (2FA)', 'wp-hide-security-enhancer') . "</b>" . 
                                                                                                                                                                                                    "<br />&nbsp;".
                                                                                                                                                                                                    "<br />" . __("For a secure and reliable method of Two-Factor Authentication (2FA), you can use any of the popular authenticator apps. These apps generate time-based, one-time passcodes (TOTP) that are used to verify your identity. To set up this method, the user simply scan the QR code provided, then enter the verification code generated by your authenticator app into the 'Verification Code' field and click 'Verify' to complete the setup process.",    'wp-hide-security-enhancer').
                                                                                                                                                                                                    "<br />&nbsp;".
                                                                                                                                                                                                    "<br />" . __("Some of the most widely supported authenticator apps include:",    'wp-hide-security-enhancer').
                                                                                                                                                                                                    "<ul>
                                                                                                                                                                                                         <li>" . __("<b>Google Authenticator</b>",    'wp-hide-security-enhancer'). "</li>
                                                                                                                                                                                                         <li>" . __("<b>Microsoft Authenticator</b>",    'wp-hide-security-enhancer'). "</li>
                                                                                                                                                                                                         <li>" . __("<b>FreeOTP</b>",    'wp-hide-security-enhancer'). "</li>
                                                                                                                                                                                                         <li>" . __("<b>Duo Mobile</b>",    'wp-hide-security-enhancer'). "</li>
                                                                                                                                                                                                         <li>" . __("<b>Authy</b>",    'wp-hide-security-enhancer'). "</li>
                                                                                                                                                                                                         <li>" . __("<b>LastPass Authenticator</b>",    'wp-hide-security-enhancer'). "</li>
                                                                                                                                                                                                    </ul><br />" . __("These apps are available for download on both Android and iOS devices, ensuring users can securely authenticate their logins from their smartphones. ",    'wp-hide-security-enhancer') .
                                                                                                                                                                                                    "<br /><br />" . __("Users can manage this option in the Profile section of their account.",    'wp-hide-security-enhancer'),
                                                                                                                                                                    'option_documentation_url'  =>  'https://wp-hide.com/documentation/2fa-authenticator-app/'
                                                                                                                                                                    ),
                                                                                                                                
                                                                                                                                'input_type'    =>  'radio',
                                                                                                                                'options'       =>  array(
                                                                                                                                                            'no'                        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                                                                            'yes'                       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                                                                            ),
                                                                                                                                ) );
                                                                break;
          
                                    
                                }
                                
                            $component_settings[ $component_key ]   =   $component_setting;
                        }
                    
                    return $component_settings;
                    
                }
                

            function _init_2fa_app( $saved_field_data )
                {
                    if ( empty ( $saved_field_data ) ||  $saved_field_data   ==  'no' )
                        return FALSE;
                        
                    add_action( 'wp_ajax_2fa_app_reset',        array( $this, 'ajax_app_reset' ) );
                    add_action( 'wp_ajax_2fa_app_code_submit',  array( $this, 'ajax_app_code_submit' ) );
                }
                
                
            function get_label()
                {
                    return __( 'Authenticator APP', 'wp-hide-security-enhancer' );   
                }
                
            public function get_other_label() 
                {
                    return __( 'Login Code using APP', 'two-factor' );
                }
     
            function login_page_HTML( $user, $args  )
                {
                        
                    if ( $this->user_require_setup( $user->ID ) )
                        {
                            include_once( WPH_PATH . '/vendors/GoogleAuthenticator.php');
                            
                            $secret =   $this->generate_app_secret( $user->ID );
                            
                            $authenticator = new PHPGangsta_GoogleAuthenticator();
                            
                            $website    = site_url();
                            $title      = $user->user_login;
                            $qrCodeUrl = $authenticator->getQRCodeGoogleUrl( $title, $secret,$website, array ( ) );
                            
                            ?>
                            <p class="_2fa-info"><b><?php esc_html_e( 'The APP authentication setup is not yet complete.', 'wp-hide-security-enhancer' ); ?></b></p>
                            <p class="_2fa-info"><?php esc_html_e( 'Use any of the following authentication applications to scan the QR code above. Then, enter the verification code from the app in the Verification Code field, and click Verify to complete the process.', 'wp-hide-security-enhancer' ); ?></p>
                            <p class="_2fa_apps_icons">
                                <a target="_blank" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2"><img src="<?php echo WPH_URL ?>/assets/images/google-auth.png" /></a> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.azure.authenticator"><img src="<?php echo WPH_URL ?>/assets/images/microsoft-auth.png" /></a> <a target="_blank" href="https://play.google.com/store/apps/details?id=org.fedorahosted.freeotp"><img src="<?php echo WPH_URL ?>/assets/images/freeotp-auth.png" /></a> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.duosecurity.duomobile"><img src="<?php echo WPH_URL ?>/assets/images/duo-auth.png" /></a> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.authy.authy"><img src="<?php echo WPH_URL ?>/assets/images/Twilio_Authy_icon_II.svg" /></a> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.lastpass.authenticator"><img src="<?php echo WPH_URL ?>/assets/images/lastpass-auth.png" /></a>
                            </p>
                            <p class="_2fa-info aligncenter"><img id="AppAuthenticator" src="<?php echo $qrCodeUrl ?>" /></p>
                            <p class="_2fa-info aligncenter"><code><?php echo $secret ?></code></p>
                            <p>&nbsp;</p>
                            <p>
                                <strong><label for="authentication_code"><?php esc_html_e( 'Verification Code:', 'wp-hide-security-enhancer' ); ?></label></strong>
                                
                                <input type="text" inputmode="numeric" name="2fa_app_code" id="authentication_code" class="input" value="" size="20" pattern="[0-9 ]*" placeholder="12345678" data-digits="8" />
                                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Verify', 'wp-hide-security-enhancer' ) ?>">
                            </p>
                            
                            <style>#login {width: 400px}</style>
                            <?php
                            
                            $this->HTML_dependencies();
                            return;
                        }
                        
                        
                    ?>
                        <p class="_2fa-info"><b><?php esc_html_e( 'APP security Code', 'wp-hide-security-enhancer' ); ?></b></p>
                        <p class="_2fa-info"><?php esc_html_e( 'Open your authentication application, retrieve the verification code, and enter it into the Verification Code field.', 'wp-hide-security-enhancer' ); ?>
                            <br /><?php esc_html_e( 'Once entered, click Verify to proceed.', 'wp-hide-security-enhancer' ); ?>
                        </p>
                                                
                        <p>&nbsp;</p>
                        <p>
                            <strong><label for="authentication_code"><?php esc_html_e( 'Verification Code:', 'wp-hide-security-enhancer' ); ?></label></strong>
                            
                            <input type="text" inputmode="numeric" name="2fa_app_code" id="authentication_code" class="input" value="" size="20" pattern="[0-9 ]*" placeholder="12345678" data-digits="8" />
                            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Log In', 'wp-hide-security-enhancer' ) ?>">
                        </p>

                    <?php
                        
                    $this->HTML_dependencies();
                     
                }
                
                
            /**
            * Add the required CSS and JavaScript dependencies
            * 
            */    
            function HTML_dependencies()
                {
                    ?>
                    <style>
                        #loginform ._2fa-info {padding-bottom: 10px;}
                        #loginform .leftalign {float: left}
                        #loginform .button-primary.red {background: #ac0f0f; border-color: #9b1313;}
                        #loginform .button-primary.red:hover {background: #550808}
                        #loginform ._2fa_apps_icons {padding: 20px 0}
                        #loginform ._2fa_apps_icons img { display: inine; max-height: 35px; margin: 0 10px; border-radius: 50%;}
                        #loginform .aligncenter {text-align: center;}
                        #loginform code {padding: 3px 5px 2px;  margin: 0 1px;  background: #f0f0f1;  background: rgba(0,0,0,.07);  font-size: 16px;}
                        #loginform #authentication_code {letter-spacing: .60em; padding-left: 20px; padding-right: 20px}
                        #loginform #authentication_code::placeholder {color:#eaeaea; font-weight: lighter;}
                    </style>
                    <script type="text/javascript">
                        setTimeout( function(){ var auth_input;
                                                auth_input = document.querySelector('#authentication_code');
                                                auth_input.value = '';
                                                auth_input.focus()}, 200);
                    
                        (function() {
                            const loginForm = document.querySelector('#loginform');
                            const numericInput = document.querySelector('input#authentication_code[inputmode="numeric"]');
         
                                numericInput.addEventListener('input', function(event) {
                                    let inputValue = event.target.value.replace(/[^0-9]+/g, '').trimStart();
                                    inputValue = inputValue.slice(0, 6);
                                    event.target.value = inputValue;
                                    const cleanedValue = inputValue.replace(/ /g, '');
                                    if (cleanedValue.length >= 6)
                                        event.target.blur();
                                    if ( cleanedValue.length === 6 ) {
                                        if (typeof loginForm.requestSubmit === 'function') {
                                            loginForm.requestSubmit();
                                            loginForm.submit.disabled = true;
                                        }
                                    }
                                });
                         
                        })();
                    </script>
                    <?php
                }
                
                
            /**
            * Before the processing authentication
            * 
            * @param mixed $user
            * @return WP_Error
            */
            function before_process_authentication( $user )
                {
                    
                    include_once( WPH_PATH . '/vendors/GoogleAuthenticator.php');
                            
                    return TRUE;
                    
                }
    
    
    

            /**
            * Process the Email Code submit
            * 
            * @param mixed $user
            * @return WP_Error
            */
            function process_authentication( $user )
                {
                    $field  =  '2fa_app_code'; 
                    if ( empty( $_REQUEST[ $field ] ) )
                        return new WP_Error( 'error', __( 'ERROR: Invalid inpput code.', 'wp-hide-security-enhancer' ));

                    $code   =   preg_replace( '/0-9/' , "",       $_REQUEST[ $field ] );
                    $secret =   $this->get_app_secret( $user->ID );
                          
                    if ( ! isset( $user->ID ) || ! $code )
                        return new WP_Error( 'error', __( 'ERROR: Invalid user or empty code.', 'wp-hide-security-enhancer' ));
                    
                    $authenticator = new PHPGangsta_GoogleAuthenticator();
                    
                    $tolerance = 0;

                    $checkResult = $authenticator->verifyCode( $secret, $code, $tolerance );    
                    if ( ! $checkResult ) 
                        return new WP_Error( 'error', __( 'ERROR: Invalid verification code.', 'wp-hide-security-enhancer' )); 

                    update_user_meta( $user->ID, '_2fa_app_setup_completed', 'true' );

                    return true;
                    
                }
                
            
            
            /**
            * Check if the user require setup for the APP
            * 
            * @param mixed $user_id
            */
            function user_require_setup( $user_id )
                {
                    $setup_completed = get_user_meta( $user_id, '_2fa_app_setup_completed', true );
                    
                    if (    $setup_completed   !==  'true' )
                        return TRUE;
                        
                    return FALSE;
                }
                
                
            
            /**
            * Generate a user secret to be used with the APP
            *     
            * @param mixed $user_id
            */
            function generate_app_secret( $user_id ) 
                {
                    $authenticator  = new PHPGangsta_GoogleAuthenticator();
                    $secret         = $authenticator->createSecret();

                    update_user_meta( $user_id, '_2fa_app_secret', $secret );

                    return $secret;
                }
                
            
            /**
            * Return the user APP secred code
            *     
            * @param mixed $user_id
            */
            function get_app_secret ( $user_id )
                {
                    $secret =   get_user_meta( $user_id, '_2fa_app_secret', TRUE );
                    
                    if ( empty ( $secret ) )
                        return FALSE;
                    
                    return $secret;   
                }
 
 
            /**
            * Reset the APP setup 
            * 
            * @param mixed $user_id
            */
            function reset_app_setup( $user_id )
                {
                    delete_user_meta( $user_id, '_2fa_app_setup_completed' );    
                }
 
 
            /**
            * Output dashboard option html
            * 
            * @param mixed $user
            */
            function interface_option_html( $user, $reset_secret    =   TRUE ) 
                {
                    
                    if ( $this->user_require_setup( $user->ID ) )
                        {
                            include_once( WPH_PATH . '/vendors/GoogleAuthenticator.php');
                            
                            if ( $reset_secret )
                                $secret =   $this->generate_app_secret( $user->ID );
                                else
                                $secret =   $this->get_app_secret( $user->ID );
                            
                            $authenticator = new PHPGangsta_GoogleAuthenticator();
                            
                            $website    = site_url();
                            $title      = $user->user_login;
                            $qrCodeUrl = $authenticator->getQRCodeGoogleUrl( $title, $secret,$website, array ( ) );
                            
                            ?>
                            <p class="_2fa-info important"><b><?php esc_html_e( 'The APP authentication setup is not yet complete.', 'wp-hide-security-enhancer' ); ?></b></p>
                            <p class="_2fa-info"><?php esc_html_e( 'Use any of the following authentication applications to scan the QR code above. Then, enter the verification code from the app in the Verification Code field, and click Verify to complete the process.', 'wp-hide-security-enhancer' ); ?></p>
                            <p class="_2fa_apps_icons">
                                <a target="_blank" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2"><img src="<?php echo WPH_URL ?>/assets/images/google-auth.png" /></a> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.azure.authenticator"><img src="<?php echo WPH_URL ?>/assets/images/microsoft-auth.png" /></a> <a target="_blank" href="https://play.google.com/store/apps/details?id=org.fedorahosted.freeotp"><img src="<?php echo WPH_URL ?>/assets/images/freeotp-auth.png" /></a> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.duosecurity.duomobile"><img src="<?php echo WPH_URL ?>/assets/images/duo-auth.png" /></a> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.authy.authy"><img src="<?php echo WPH_URL ?>/assets/images/Twilio_Authy_icon_II.svg" /></a> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.lastpass.authenticator"><img src="<?php echo WPH_URL ?>/assets/images/lastpass-auth.png" /></a>
                            </p>
                            <p class="_2fa-info aligncenter"><img id="AppAuthenticator" src="<?php echo $qrCodeUrl ?>" /></p>
                            <code><?php echo $secret ?></code>
                            
                            <p>&nbsp;</p>
                            <p><strong><label for="authentication_code"><?php esc_html_e( 'Verification Code:', 'wp-hide-security-enhancer' ); ?></label></strong></p>
                            <p>
                                <input type="text" inputmode="numeric" id="_2fa_app_code" name="2fa_app_code" id="authentication_code" class="input" value="" size="20" pattern="[0-9 ]*" placeholder="12345678" data-digits="8" />
                                <input type="submit" name="submit" id="2fa_app_code_submit" class="button button-primary" value="<?php _e( 'Verify', 'wp-hide-security-enhancer' ) ?>">
                            </p>
                            
                            <?php

                            return;
                        }
                        
                    ?>
                        <p class="_2fa-info"><?php _e( "The authenticator app is currently configured. If you reset it, you'll need to re-scan the QR code on all your devices to restore access. Ensure you have the necessary QR code or recovery details ready before proceeding to avoid disruptions to your account security or accessibility.", 'wp-hide-security-enhancer' ); ?></p>
                        <input type="submit" id="wph_2fa_app_reset" class="button action" value="<?php _e( 'Reset Authentication APP', 'two-factor' ); ?>">
                    <?php
                        
                    
                }
                
                
                
            /**
            * Process the ajax call 
            * 
            */
            function ajax_app_reset() 
                {
                    
                    if( !isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'wph_2fa_nonce') )
                        wp_die('Permission denied');

                    $current_user = wp_get_current_user();
                    if (    ! $current_user instanceof WP_User )
                        wp_die('Permission denied');   
                    
                    $this->reset_app_setup( $current_user->ID );
                             
                    ob_start();
                    
                    $this->interface_option_html( $current_user );
                    
                    $html   =   ob_get_contents();
                    ob_end_clean();

                    echo $html;
                    
                    wp_die();
                    
                }
                
            
            /**
            * Process the ajax call for app verification
            *     
            */
            function ajax_app_code_submit()
                {
                    if( !isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'wph_2fa_nonce') )
                        wp_die('Permission denied');

                    $current_user = wp_get_current_user();
                    if (    ! $current_user instanceof WP_User )
                        wp_die('Permission denied');   
                    
                    
                    $code   =   preg_replace( '/0-9/' , "",       $_POST[ 'app_code' ] );
                    $secret =   $this->get_app_secret( $current_user->ID );
                    
                    include_once( WPH_PATH . '/vendors/GoogleAuthenticator.php');
                    $authenticator = new PHPGangsta_GoogleAuthenticator();
                    
                    $tolerance = 1;

                    $checkResult = $authenticator->verifyCode( $secret, $code, $tolerance );    
                    if ( ! $checkResult ) 
                        _e( '<p class="notice error">' . 'Error: Invalid verification code.', 'wp-hide-security-enhancer' . '</p' );
                        else
                        update_user_meta( $current_user->ID, '_2fa_app_setup_completed', 'true' );
                    
                             
                    ob_start();
                    
                    $this->interface_option_html( $current_user, FALSE );
                    
                    $html   =   ob_get_contents();
                    ob_end_clean();

                    echo $html;
                    
                    wp_die();   
                }
 

        }
?>