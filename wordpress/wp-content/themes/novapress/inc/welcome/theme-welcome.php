<?php
/**
 * Welcome Screen Class
 */
class novapress_welcome {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'novapress_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'admin_init', array( $this, 'novapress_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'novapress_welcome_style_and_scripts' ) );

		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'novapress_welcome_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'novapress_welcome', array( $this, 'novapress_welcome_getting_started' ) );
		add_action('admin_init',array($this,'dismiss_welcome'),1);

		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_novapress_dismiss_required_action', array( $this, 'novapress_dismiss_required_action_callback') );
		add_action( 'wp_ajax_nopriv_novapress_dismiss_required_action', array($this, 'novapress_dismiss_required_action_callback') );

	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.8.2.4
	 */
	public function novapress_welcome_register_menu() {
		add_theme_page( __( 'Setup Novapress', 'novapress' ), __( 'Setup Novapress', 'novapress' ), 'activate_plugins', 'novapress-welcome', array( $this, 'novapress_welcome_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.8.2.4
	 */
	public function novapress_activation_admin_notice() {
		global $current_user;

		if ( is_admin()) {

			$current_theme = wp_get_theme();
			$welcome_dismissed = get_user_meta($current_user->ID,'novapress_welcome_admin_notice');

			if($current_theme->get('Name')== "Novapress" && !$welcome_dismissed){
				add_action( 'admin_notices', array( $this, 'novapress_welcome_admin_notice' ), 99 );
			}

		}
	}
	function dismiss_welcome() {
		global $current_user;
		$user_id = $current_user->ID;

		if ( isset($_GET['novapress_welcome_dismiss']) && $_GET['novapress_welcome_dismiss'] == '1' ) {
			add_user_meta($user_id, 'novapress_welcome_admin_notice', 'true', true);
		}
	}
	/**
	 * Display an admin notice linking to the welcome screen
	 */
	public function novapress_welcome_admin_notice() {

		$dismiss_url = '<a href="' . esc_url( wp_nonce_url( add_query_arg( 'novapress_welcome_dismiss', '1' ) ) ) . '" class="button" target="_parent">' . __('Dismiss this notice','novapress') . '</a>';
		?>
			<div class="notice theme-notice is-dismissible">
				<ul>
					<li class="left">
						<h2><?php _e( 'Welcome! Thank you for choosing Novapress!', 'novapress' ); ?></h2>
		                <p><?php _e( 'Visit our welcome page to setup Novapress and start customizing your site.', 'novapress' ); ?></p>
						<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=novapress-welcome' ) ); ?>" class="button button-primary" style="text-decoration: none;"><?php _e( 'Setup Novapress', 'novapress' ); ?></a> <?php echo $dismiss_url ?></p>
					</li>
					<li class="right">
						<a target="_blank" href="<?php echo esc_url('https://www.themely.com/themes/novapress-viralnova-clone-wordpress-theme/'); ?>" class="button button-primary button-hero" style="text-decoration: none;"><?php _e( 'Upgrade to Novapress Pro!', 'novapress' ); ?></a>
					</li>
				</ul>
			</div>
			<style>
				.theme-notice {border:2px dashed red;max-width:800px;}
				.theme-notice ul {width:100%;margin:0;}
				.theme-notice ul li {display: inline-block;}
				.theme-notice .right {margin-left: 50px;}
				.theme-notice .button-hero {float: right;margin-bottom: 12px;}
			</style>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 * @since  1.8.2.4
	 */
	public function novapress_welcome_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_novapress-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'novapress-welcome-screen-css', get_template_directory_uri() . '/inc/welcome/css/welcome.css' );

			global $novapress_required_actions;

			$nr_actions_required = 0;

			/* get number of required actions */
			if( get_option('novapress_show_required_actions') ):
				$novapress_show_required_actions = get_option('novapress_show_required_actions');
			else:
				$novapress_show_required_actions = array();
			endif;

			if( !empty($novapress_required_actions) ):
				foreach( $novapress_required_actions as $novapress_required_action_value ):
					if(( !isset( $novapress_required_action_value['check'] ) || ( isset( $novapress_required_action_value['check'] ) && ( $novapress_required_action_value['check'] == false ) ) ) && ((isset($novapress_show_required_actions[$novapress_required_action_value['id']]) && ($novapress_show_required_actions[$novapress_required_action_value['id']] == true)) || !isset($novapress_show_required_actions[$novapress_required_action_value['id']]) )) :
						$nr_actions_required++;
					endif;
				endforeach;
			endif;

			wp_localize_script( 'novapress-welcome-screen-js', 'NovapressWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','novapress' )
			) );
		}
	}

	/**
	 * Load scripts for customizer page
	 * @since  1.8.2.4
	 */
	public function novapress_welcome_scripts_for_customizer() {

		global $novapress_required_actions;

		$nr_actions_required = 0;

		/* get number of required actions */
		if( get_option('novapress_show_required_actions') ):
			$novapress_show_required_actions = get_option('novapress_show_required_actions');
		else:
			$novapress_show_required_actions = array();
		endif;

		if( !empty($novapress_required_actions) ):
			foreach( $novapress_required_actions as $novapress_required_action_value ):
				if(( !isset( $novapress_required_action_value['check'] ) || ( isset( $novapress_required_action_value['check'] ) && ( $novapress_required_action_value['check'] == false ) ) ) && ((isset($novapress_show_required_actions[$novapress_required_action_value['id']]) && ($novapress_show_required_actions[$novapress_required_action_value['id']] == true)) || !isset($novapress_show_required_actions[$novapress_required_action_value['id']]) )) :
					$nr_actions_required++;
				endif;
			endforeach;
		endif;

		wp_localize_script( 'novapress-welcome-screen-customizer-js', 'NovapressWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=novapress-welcome#actions_required' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
			'themeinfo' => __('View Theme Info','novapress'),
		) );
	}

	/**
	 * Dismiss required actions
	 * @since 1.8.2.4
	 */
	public function novapress_dismiss_required_action_callback() {

		global $novapress_required_actions;

		$novapress_dismiss_id = (isset($_GET['dismiss_id'])) ? $_GET['dismiss_id'] : 0;

		echo $novapress_dismiss_id; /* this is needed and it's the id of the dismissable required action */

		if( !empty($novapress_dismiss_id) ):

			/* if the option exists, update the record for the specified id */
			if( get_option('novapress_show_required_actions') ):

				$novapress_show_required_actions = get_option('novapress_show_required_actions');

				$novapress_show_required_actions[$novapress_dismiss_id] = false;

				update_option( 'novapress_show_required_actions',$novapress_show_required_actions );

			/* create the new option,with false for the specified id */
			else:

				$novapress_show_required_actions_new = array();

				if( !empty($novapress_required_actions) ):

					foreach( $novapress_required_actions as $novapress_required_action ):

						if( $novapress_required_action['id'] == $novapress_dismiss_id ):
							$novapress_show_required_actions_new[$novapress_required_action['id']] = false;
						else:
							$novapress_show_required_actions_new[$novapress_required_action['id']] = true;
						endif;

					endforeach;

				update_option( 'novapress_show_required_actions', $novapress_show_required_actions_new );

				endif;

			endif;

		endif;

		die(); // this is required to return a proper result
	}


	/**
	 * Welcome screen content
	 * @since 1.8.2.4
	 */
	public function novapress_welcome_screen() {

		?>
        
        <div class="wrap about-wrap theme-welcome">
            <h1><?php esc_html_e('Welcome to Novapress - Version 1.1.4', 'novapress'); ?></h1>
            <div class="about-text"><?php esc_html_e('Start your own viral news site / blog with Novapress. Inspired by Viral Nova, it is designed to help boost social shares and get you more viral traffic from top social media websites.', 'novapress'); ?></div>
            <a class="wp-badge" href="https://www.themely.com/" target="_blank"><span><?php esc_html_e('Visit Themely', 'novapress'); ?></span></a>
            <div class="clearfix"></div>
            <h2 class="nav-tab-wrapper">
                <a class="nav-tab nav-tab-active"><?php esc_html_e('Get Started', 'novapress'); ?></a>
            </h2>
            <div class="info-tab-content">
                <div class="left">
                    <div>
                        <h3><?php esc_html_e('Step 1 - Install Plugins', 'novapress'); ?></h3>
                        <ol>
                            <li><?php esc_html_e('Install', 'novapress'); ?> <a target="_blank" href="<?php echo esc_url('https://wordpress.org/plugins/social-pug/', 'novapress'); ?>"><?php esc_html_e('Social Pug - Social Share Buttons', 'novapress'); ?></a> <?php esc_html_e('plugin', 'novapress'); ?></li>
                        </ol>
                        <p>
                            <a class="button button-secondary" href="<?php echo esc_url('themes.php?page=tgmpa-install-plugins'); ?>"><?php esc_html_e('Install Plugins Here', 'novapress'); ?></a>
                        </p>
                    </div>
                    <div>
                        <h3><?php esc_html_e('Step 2 - Configure Plugins', 'novapress'); ?></h3>
                        <p><?php esc_html_e('Certain plugins will need to be configured in order for the theme to function as intended. It will only require a few minutes of your time. Click the button below to read the configuration instructions.', 'novapress'); ?></p>
                        <p><a class="button button-secondary" target="_blank" href="http://support.themely.com/knowledgebase/novapress-configure-plugins/"><?php esc_html_e('Configuration Instructions', 'novapress'); ?></a></p>
                    </div>
                    <div>
                        <h3><?php esc_html_e('Step 3 - Import Demo Content (OPTIONAL)', 'novapress'); ?></h3>
                        <p><?php esc_html_e('Make your site look like our live demo; import all demo pages, posts, widgets and theme options.', 'novapress'); ?> <?php esc_html_e('Live demo:', 'novapress'); ?> <a target="_blank" href="<?php echo esc_url('http://demo.themely.com/novapress/'); ?>">http://demo.themely.com/novapress/</a></p>
                        <p><a class="button button-secondary" target="_blank" href="http://support.themely.com/knowledgebase/novapress-import-demo-content/"><?php esc_html_e('Demo Import Instructions', 'novapress'); ?></a></p>
                    </div>
                    <div>
                        <h3><?php esc_html_e('Theme Customizer', 'novapress'); ?></h3>
                        <p class="about"><?php esc_html_e('Novapress supports the default Wordpress Customizer for all theme settings. Click the button below to start customizing your site.', 'novapress'); ?></p>
                        <p>
                            <a class="button button-primary button-hero" href="<?php echo wp_customize_url(); ?>"><?php esc_html_e('Novapress Customizer', 'novapress'); ?></a>
                        </p>
                    </div>
                    <div>
                        <h3><?php esc_html_e('Theme Support', 'novapress'); ?></h3>
                        <p class="about"><?php esc_html_e('Support for Novapress is conducted through our support ticket system.', 'novapress'); ?></p>
                        <ul class="ul-square">
                            <li><a target="_blank" href="http://support.themely.com/forums/"><?php esc_html_e('Support Forum', 'novapress'); ?></a></li>
                            <li><a target="_blank" href="http://support.themely.com/section/novapress/"><?php esc_html_e('Theme Documentation', 'novapress'); ?></a></li>
                        </ul>
                        <p><a class="button button-secondary" target="_blank" href="http://support.themely.com/forums/"><?php esc_html_e('Create a support ticket', 'novapress'); ?></a></p>
                    </div>
                </div>
                <div class="right">
                    <div class="upgrade">
                        <h3><?php esc_html_e('Upgrade to Novapress Pro!', 'novapress'); ?></h3>
                        <p class="about"><?php esc_html_e('Unlock all theme features!', 'novapress'); ?> <a target="_blank" href="http://demo.themely.com/novapress/"><?php esc_html_e('View the live demo', 'novapress'); ?></a></p>
                        <ul class="ul-square">
                            <li><?php esc_html_e('Customize font type and size (no coding required)', 'novapress'); ?></li>
                            <li><?php esc_html_e('Customize theme colors (background, color for text, links, headings, menu and accents) - no coding required', 'novapress'); ?></li>
                            <li><?php esc_html_e('Customize theme footer copyright text', 'novapress'); ?></li>
                            <li><?php esc_html_e('Customize page layout (number of columns in grid)', 'novapress'); ?></li>
                            <li><?php esc_html_e('Switch between Facebook or Wordpress comments system', 'novapress'); ?></li>
                            <li><?php esc_html_e('MONETIZE your site with 3 custom ad spots', 'novapress'); ?></li>
                            <li><?php esc_html_e('MORE Theme Customizor Options', 'novapress'); ?></li>
                            <li><?php esc_html_e('MORE Widget Areas', 'novapress'); ?></li>
                            <li><?php esc_html_e('UNLOCK support & styling for Mailchimp Forms', 'novapress'); ?></li>
                            <li><?php esc_html_e('UNLOCK support & styling for trending posts widget', 'novapress'); ?></li>
                            <li><?php esc_html_e('UNLOCK infinite page scroll feature', 'novapress'); ?></li>
                            <li><?php esc_html_e('UNLOCK the footer widgets area', 'novapress'); ?></li>
                            <li><?php esc_html_e('UNLOCK 2 newsletter sections', 'novapress'); ?></li>
                            <li><?php esc_html_e('UNLOCK author bio section on posts', 'novapress'); ?></li>
                            <li><?php esc_html_e('FREE Child Theme', 'novapress'); ?></li>
                            <li><?php esc_html_e('No restrictions!', 'novapress'); ?></li>
                            <li><?php esc_html_e('Priority support', 'novapress'); ?></li>
                            <li><?php esc_html_e('Regular theme updates', 'novapress'); ?></li>
                        </ul>
                        <p>
                            <a class="button button-primary button-hero" target="_blank" href="https://www.themely.com/themes/novapress-viralnova-clone-wordpress-theme/"><?php esc_html_e('UPGRADE NOW', 'novapress'); ?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
	}

}

$GLOBALS['novapress_Welcome'] = new novapress_Welcome();