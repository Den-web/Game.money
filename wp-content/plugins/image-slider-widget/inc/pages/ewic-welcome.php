<?php
/**
 * Weclome Page Class
 *
 * @package     EWIC
 * @since       1.1.15
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * EWIC_Welcome Class
 *
 * A general class for About and Credits page.
 *
 * @since 1.1.15
 */
class EWIC_Welcome {

	/**
	 * @var string The capability users should have to view the page
	 */
	public $minimum_capability = 'manage_options';

	/**
	 * Get things started
	 *
	 * @since 1.1.15
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'ewic_admin_menus') );
		add_action( 'admin_head', array( $this, 'ewic_admin_head' ) );
		add_action( 'admin_init', array( $this, 'ewic_welcome_page' ) );
	}

	/**
	 * Register the Dashboard Pages which are later hidden but these pages
	 * are used to render the Welcome and Credits pages.
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function ewic_admin_menus() {

			// What's New / Overview
    		add_submenu_page('edit.php?post_type=easyimageslider', 'What\'s New', 'What\'s New<span style="font-weight: bold;font-size:8px;letter-spacing: 1px;color:#fff; border: solid 1px #fff; padding: 0 5px 0 5px; border-radius: 15px; -moz-border-radius: 15px;-webkit-border-radius: 15px; background: red; margin-left: 7px;">NEW</span>', $this->minimum_capability, 'ewic-whats-new', array( $this, 'ewic_about_screen') );
			
			// Changelog Page
    		add_submenu_page('edit.php?post_type=easyimageslider', EWIC_NAME.' Changelog', EWIC_NAME.' Changelog', $this->minimum_capability, 'ewic-changelog', array( $this, 'ewic_changelog_screen') );
			
			// Getting Started Page
    		add_submenu_page('edit.php?post_type=easyimageslider', 'Getting started with '.EWIC_NAME.'', 'Getting started with '.EWIC_NAME.'', $this->minimum_capability, 'ewic-getting-started', array( $this, 'ewic_getting_started_screen') );
			
			// Free Plugins Page
    		add_submenu_page('edit.php?post_type=easyimageslider', 'Free Install Plugins', 'Free Install Plugins', $this->minimum_capability, 'ewic-free-plugins', array( $this, 'free_plugins_screen') );
			
			// Premium Plugins Page
    		add_submenu_page('edit.php?post_type=easyimageslider', 'Premium Plugins', 'Premium Plugins', $this->minimum_capability, 'ewic-premium-plugins', array( $this, 'premium_plugins_screen') );
			
			// Addons Page
    		add_submenu_page('edit.php?post_type=easyimageslider', 'Addons', 'Addons', $this->minimum_capability, 'ewic-addons', array( $this, 'addons_plugins_screen') );
			
			// Earn EXTRA MONEY Page
    		add_submenu_page('edit.php?post_type=easyimageslider', 'Earn EXTRA MONEY', 'Earn EXTRA MONEY', $this->minimum_capability, 'ewic-earn-xtra-money', array( $this, 'earn_plugins_screen') );
			
			// Pricing Page
			add_submenu_page('edit.php?post_type=easyimageslider', 'Pricing & compare tables', __('UPGRADE to PRO', 'easywic'), $this->minimum_capability, 'ewic-comparison', 'ewic_pricing_table');
			
			// Settings Page
			add_submenu_page('edit.php?post_type=easyimageslider', 'Global Settings', __('Global Settings', 'easywic'), $this->minimum_capability, 'ewic-settings-page', 'ewic_stt_page');
			
				
	}

	/**
	 * Hide Individual Dashboard Pages
	 *
	 * @access public
	 * @since 1.1.15
	 * @return void
	 */
	public function ewic_admin_head() {
		remove_submenu_page( 'edit.php?post_type=easyimageslider', 'ewic-changelog' );
		remove_submenu_page( 'edit.php?post_type=easyimageslider', 'ewic-getting-started' );
		//remove_submenu_page( 'edit.php?post_type=easyimageslider', 'ewic-free-plugins' );
		//remove_submenu_page( 'edit.php?post_type=easyimageslider', 'ewic-premium-plugins' );
		remove_submenu_page( 'edit.php?post_type=easyimageslider', 'ewic-addons' );
		remove_submenu_page( 'edit.php?post_type=easyimageslider', 'ewic-earn-xtra-money' );

		// Badge for welcome page
		$badge_url = EWIC_URL . '/images/assets/slider-logo.png';
		?>
		<style type="text/css" media="screen">
		/*<![CDATA[*/
		.ewic-badge {
			padding-top: 150px;
			height: 128px;
			width: 128px;
			color: #666;
			font-weight: bold;
			font-size: 14px;
			text-align: center;
			text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
			margin: 0 -5px;
			background: url('<?php echo $badge_url; ?>') no-repeat;
		}

		.about-wrap .ewic-badge {
			position: absolute;
			top: 0;
			right: 0;
		}

		.ewic-welcome-screenshots {
			float: right;
			margin-left: 10px!important;
		}

		.about-wrap .feature-section {
			margin-top: 20px;
		}
		
		
		.about-wrap .feature-section .plugin-card h4 {
    		margin: 0px 0px 12px;
    		font-size: 18px;
    		line-height: 1.3;
		}
		
		.about-wrap .feature-section .plugin-card-top p {
    		font-size: 13px;
    		line-height: 1.5;
    		margin: 1em 0px;
		}	
				
		.about-wrap .feature-section .plugin-card-bottom {
    		font-size: 13px;
		}	
		
		.customh3 {

		}
		
		
		.customh4 {
			display:inline-block;
			border-bottom: 1px dashed #CCC;
		}
		
		
		.ewic-dollar {
		
		background: url('<?php echo EWIC_URL . '/images/assets/dollar.png'; ?>') no-repeat;
		color: #2984E0;
			
		}
		
		.ewic-affiliate-screenshots {
			-webkit-box-shadow: -3px 1px 15px -4px rgba(0,0,0,0.75);
			-moz-box-shadow: -3px 1px 15px -4px rgba(0,0,0,0.75);
			box-shadow: -3px 1px 15px -4px rgba(0,0,0,0.75);
			float: right;
			margin: 20px 0 30px 30px !important;
		}
		
		
		.button_loading {
    		background: url('<?php echo EWIC_URL . '/images/assets/gen-loader.gif'; ?>') no-repeat 50% 50%;
    		/* apply other styles to "loading" buttons */
			display:inline-block;
			position:relative;
			width: 16px;
			height: 16px;
			top: 17px;
			margin-left: 10px;
			}
			
		.ewic-aff-note {
			color:#F00;
			font-size:12px;
			font-style:italic;
		}
		
		

		/*]]>*/
		</style>
		<?php
	}

	/**
	 * Navigation tabs
	 *
	 * @access public
	 * @since 1.1.15
	 * @return void
	 */
	public function ewic_tabs() {
		$selected = isset( $_GET['page'] ) ? $_GET['page'] : 'ewic-whats-new';
		?>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php echo $selected == 'ewic-whats-new' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'ewic-whats-new' ), 'edit.php?post_type=easyimageslider' ) ) ); ?>">
				<?php _e( "What's New", 'easywic' ); ?>
			</a>
			<a class="nav-tab <?php echo $selected == 'ewic-getting-started' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'ewic-getting-started' ), 'edit.php?post_type=easyimageslider' ) ) ); ?>">
				<?php _e( 'Getting Started', 'easywic' ); ?>
			</a>
			<a class="nav-tab <?php echo $selected == 'ewic-addons' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'ewic-addons' ), 'edit.php?post_type=easyimageslider' ) ) ); ?>">
				<?php _e( 'Addons', 'easywic' ); ?>
			</a>
            
			<a class="nav-tab <?php echo $selected == 'ewic-free-plugins' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'ewic-free-plugins' ), 'edit.php?post_type=easyimageslider' ) ) ); ?>">
				<?php _e( 'Free Plugins', 'easywic' ); ?>
			</a>
            
			<a class="nav-tab <?php echo $selected == 'ewic-premium-plugins' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'ewic-premium-plugins' ), 'edit.php?post_type=easyimageslider' ) ) ); ?>">
				<?php _e( 'Premium Plugins', 'easywic' ); ?>
			</a>
            
			<a class="nav-tab <?php echo $selected == 'ewic-earn-xtra-money' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'ewic-earn-xtra-money' ), 'edit.php?post_type=easyimageslider' ) ) ); ?>">
				<?php _e( '<span class="ewic-dollar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Extra</span>', 'easywic' ); ?>
			</a>
          
            
            
		</h2>
		<?php
	}

	/**
	 * Render About Screen
	 *
	 * @access public
	 * @since 1.1.15
	 * @return void
	 */
	public function ewic_about_screen() {
		list( $display_version ) = explode( '-', EWIC_VERSION );
		?>
		<div class="wrap about-wrap">
			<h1><?php printf( __( 'Welcome to '.EWIC_NAME.'', 'easywic' ), $display_version ); ?></h1>
			<div class="about-text"><?php printf( __( 'Thank you for installing '.EWIC_NAME.'. This plugin is ready to make your slider more fancy and better!', 'easywic' ), $display_version ); ?></div>
			<div class="ewic-badge"><?php printf( __( 'Version %s', 'easywic' ), $display_version ); ?></div>

			<?php $this->ewic_tabs(); ?>
            
            <?php ewic_lite_get_news();  ?>

			<div class="ewic-container-cnt">
				<h3 class="customh3"><?php _e( 'New Welcome Page', 'easywic' );?></h3>

				<div class="feature-section">

					<p><?php _e( 'Version 1.1.15 introduces a comprehensive welcome page interface. The easy way to get important informations about this product and other related plugins.', 'easywic' );?></p>
                    
					<p><?php _e( 'In this page, you will find four important Tabs named Getting Started, Addons, Free Plugins, Premium Plugins and Extra.', 'easywic' );?></p>

				</div>
			</div>

			<div class="ewic-container-cnt">
				<h3 class="customh3"><?php _e( 'ADDONS', 'easywic' );?></h3>

				<div class="feature-section">

					<p><?php _e( 'Need some Pro version features to be applied in your Free version? What you have to do just go to <strong>Addons</strong> page and choose any Addons that you want to install. All listed addons are Premium version.', 'easywic' );?></p>

				</div>
			</div>

			<div class="ewic-container-cnt">
				<h3><?php _e( 'Additional Updates', 'easywic' );?></h3>

				<div class="feature-section col three-col">
					<div>

						<h4><?php _e( 'CSS Clean and Optimization', 'easywic' );?></h4>
						<p><?php _e( 'We\'ve improved some css class to make your slider for look fancy and better.', 'easywic' );?></p>

					</div>

					<div>

						<h4><?php _e( 'Disable Notifications', 'easywic' );?></h4>
						<p><?php _e( 'In this version you will no longer see some annoying notifications in top of slider editor page. Thanks for who suggested it.' ,'easywic' );?></p>
                        
					</div>

					<div class="last-feature">

						<h4><?php _e( 'Improved Several Function', 'easywic' );?></h4>
						<p><?php _e( 'Slider function has been improved to be more robust and fast so you can create slider only in minutes.', 'easywic' );?></p>

					</div>

				</div>
			</div>

			<div class="return-to-dashboard">&middot;<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'ewic-changelog' ), 'edit.php?post_type=easyimageslider' ) ) ); ?>"><?php _e( 'View the Full Changelog', 'easywic' ); ?></a>
			</div>
		</div>
		<?php
	}

	/**
	 * Render Changelog Screen
	 *
	 * @access public
	 * @since 1.1.15
	 * @return void
	 */
	public function ewic_changelog_screen() {
		list( $display_version ) = explode( '-', EWIC_VERSION );
		?>
		<div class="wrap about-wrap">
			<h1><?php _e( EWIC_NAME. ' Changelog', 'easywic' ); ?></h1>
			<div class="about-text"><?php printf( __( 'Thank you for installing '.EWIC_NAME.'. This plugin is ready to make your slider more fancy and better!', 'easywic' ), $display_version ); ?></div>
			<div class="ewic-badge"><?php printf( __( 'Version %s', 'easywic' ), $display_version ); ?></div>

			<?php $this->ewic_tabs(); ?>

			<div class="ewic-container-cnt">
				<h3><?php _e( 'Full Changelog', 'easywic' );?></h3>
				<div>
					<?php echo $this->parse_readme(); ?>
				</div>
			</div>

		</div>
		<?php
	}

	/**
	 * Render Getting Started Screen
	 *
	 * @access public
	 * @since 1.9
	 * @return void
	 */
	public function ewic_getting_started_screen() {
		list( $display_version ) = explode( '-', EWIC_VERSION );
		?>
		<div class="wrap about-wrap">
			<h1><?php printf( __( 'Welcome to '.EWIC_NAME.' %s', 'easywic' ), $display_version ); ?></h1>
			<div class="about-text"><?php printf( __( 'Thank you for installing '.EWIC_NAME.'. This plugin is ready to make your slider more fancy and better!', 'easywic' ), $display_version ); ?></div>
			<div class="ewic-badge"><?php printf( __( 'Version %s', 'easywic' ), $display_version ); ?></div>

			<?php $this->ewic_tabs(); ?>

			<p class="about-description"><?php _e( 'There are no complicated instructions for using '.EWIC_NAME.' plugin because this plugin designed to make all easy. Please watch the following video and we believe that you will easily to understand it just in minutes :', 'easywic' ); ?></p>

			<div class="ewic-container-cnt">
				<div class="feature-section">
                <iframe width="853" height="480" src="https://www.youtube.com/embed/-W8u_t05K2Y?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
            </div>

			<div class="ewic-container-cnt">
				<h3><?php _e( 'Need Help?', 'easywic' );?></h3>

				<div class="feature-section">

					<h4><?php _e( 'Phenomenal Support','easywic' );?></h4>
					<p><?php _e( 'We do our best to provide the best support we can. If you encounter a problem or have a question, post a question in the <a href="https://wordpress.org/support/plugin/image-slider-widget" target="_blank">support forums</a>.', 'easywic' );?></p>

					<h4><?php _e( 'Need Even Faster Support?', 'easywic' );?></h4>
					<p><?php _e( 'Just upgrade to <a target="_blank" href="http://demo.ghozylab.com/plugins/easy-image-slider-plugin/pricing/">Pro version</a> and you will get Priority Support are there for customers that need faster and/or more in-depth assistance.', 'easywic' );?></p>

				</div>
			</div>

			<div class="ewic-container-cnt">
				<h3><?php _e( 'Stay Up to Date', 'easywic' );?></h3>

				<div class="feature-section">

					<h4><?php _e( 'Get Notified of Addons Releases','easywic' );?></h4>
					<p><?php _e( 'New Addons that make '.EWIC_NAME.' even more powerful are released nearly every single week. Subscribe to the newsletter to stay up to date with our latest releases. <a target="_blank" href="http://eepurl.com/bq3RcP" target="_blank">Signup now</a> to ensure you do not miss a release!', 'easywic' );?></p>

				</div>
			</div>

		</div>
		<?php
	}
	
	
	
	/**
	 * Render Free Plugins
	 *
	 * @access public
	 * @since 1.1.15
	 * @return void
	 */
	public function free_plugins_screen() {
		list( $display_version ) = explode( '-', EWIC_VERSION );
		?>
		<div class="wrap about-wrap">
			<h1><?php printf( __( 'Welcome to '.EWIC_NAME.' %s', 'easywic' ), $display_version ); ?></h1>
			<div class="about-text"><?php printf( __( 'Thank you for installing '.EWIC_NAME.'. This plugin is ready to make your slider more fancy and better!', 'easywic' ), $display_version ); ?></div>
			<div class="ewic-badge"><?php printf( __( 'Version %s', 'easywic' ), $display_version ); ?></div>

			<?php $this->ewic_tabs(); ?>

			<div class="ewic-container-cnt">

				<div class="feature-section">
					<?php echo ewic_free_plugin_page(); ?>
				</div>
			</div>

		</div>
		<?php
	}
	
	
	/**
	 * Render Premium Plugins
	 *
	 * @access public
	 * @since 1.1.15
	 * @return void
	 */
	public function premium_plugins_screen() {
		list( $display_version ) = explode( '-', EWIC_VERSION );
		?>
		<div class="wrap about-wrap" id="ghozy-featured">
			<h1><?php printf( __( 'Welcome to '.EWIC_NAME.' %s', 'easywic' ), $display_version ); ?></h1>
			<div class="about-text"><?php printf( __( 'Thank you for installing '.EWIC_NAME.'. This plugin is ready to make your slider more fancy and better!', 'easywic' ), $display_version ); ?></div>
			<div class="ewic-badge"><?php printf( __( 'Version %s', 'easywic' ), $display_version ); ?></div>

			<?php $this->ewic_tabs(); ?>

			<div class="ewic-container-cnt">
			<p style="margin-bottom:50px;"class="about-description"></p>

				<div class="feature-section">
					<?php echo ewic_get_feed(); ?>
				</div>
			</div>

		</div>
		<?php
	}
	
	
	
	/**
	 * Render Addons Page
	 *
	 * @access public
	 * @since 1.1.15
	 * @return void
	 */
	public function addons_plugins_screen() {
		list( $display_version ) = explode( '-', EWIC_VERSION );
		?>
		<div class="wrap about-wrap" id="ghozy-addons">
			<h1><?php printf( __( 'Welcome to '.EWIC_NAME.' %s', 'easywic' ), $display_version ); ?></h1>
			<div class="about-text"><?php printf( __( 'Thank you for installing '.EWIC_NAME.'. This plugin is ready to make your slider more fancy and better!', 'easywic' ), $display_version ); ?></div>
			<div class="ewic-badge"><?php printf( __( 'Version %s', 'easywic' ), $display_version ); ?></div>

			<?php $this->ewic_tabs(); ?>

			<div class="ewic-container-cnt">
			<p style="margin-bottom:50px;"class="about-description"></p>

				<div class="feature-section">
					<?php echo ewic_lite_get_addons_feed(); ?>
				</div>
			</div>

		</div>
		<?php
	}
	
	
	
	/**
	 * Render Addons Page
	 *
	 * @access public
	 * @since 1.1.15
	 * @return void
	 */
	public function earn_plugins_screen() {
		list( $display_version ) = explode( '-', EWIC_VERSION );
		?>
		<div class="wrap about-wrap" id="ghozy-addons">
			<h1><?php printf( __( 'Welcome to '.EWIC_NAME.' %s', 'easywic' ), $display_version ); ?></h1>
			<div class="about-text"><?php printf( __( 'Thank you for installing '.EWIC_NAME.'. This plugin is ready to make your slider more fancy and better!', 'easywic' ), $display_version ); ?></div>
			<div class="ewic-badge"><?php printf( __( 'Version %s', 'easywic' ), $display_version ); ?></div>

			<?php $this->ewic_tabs(); ?>

			<div class="ewic-container-cnt">
				<div class="feature-section">
					<?php ewic_earn_xtra_money(); ?>
				</div>
			</div>

		</div>
		<?php
	}
	
	

	/**
	 * Parse the EDD readme.txt file
	 *
	 * @since 2.0.3
	 * @return string $readme HTML formatted readme file
	 */
	public function parse_readme() {
		$file = file_exists( EWIC_PLUGIN_DIR . 'readme.txt' ) ? EWIC_PLUGIN_DIR . 'readme.txt' : null;

		if ( ! $file ) {
			$readme = '<p>' . __( 'No valid changlog was found.', 'easywic' ) . '</p>';
		} else {
			$readme = file_get_contents( $file );
			$readme = nl2br( esc_html( $readme ) );
			$readme = explode( '== Changelog ==', $readme );
			$readme = end( $readme );

			$readme = preg_replace( '/`(.*?)`/', '<code>\\1</code>', $readme );
			$readme = preg_replace( '/[\040]\*\*(.*?)\*\*/', ' <strong>\\1</strong>', $readme );
			$readme = preg_replace( '/[\040]\*(.*?)\*/', ' <em>\\1</em>', $readme );
			$readme = preg_replace( '/= (.*?) =/', '<h4>\\1</h4>', $readme );
			$readme = preg_replace( '/\[(.*?)\]\((.*?)\)/', '<a href="\\2">\\1</a>', $readme );
		}

		return $readme;
	}

	/**
	 * Sends user to the Welcome page on first activation of EDD as well as each
	 * time EDD is upgraded to a new version
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function ewic_welcome_page() {	
		
    if ( is_admin() && get_option( 'activatedewic' ) == 'ewic-activate' && !is_network_admin() ) {
		delete_option( 'activatedewic' );
		wp_safe_redirect( admin_url( 'edit.php?post_type=easyimageslider&page=ewic-whats-new' ) ); exit;
		
    	}

	}
}
new EWIC_Welcome();
