<?php

function airbrake_wordpress_admin_menu () {
    add_menu_page( AW_TITLE, 'Airbrake Wordpress', 'administrator', AW_SLUG, 'airbrake_wordpress_settings' );
}

function airbrake_wordpress_settings ()
	{
		?>
		<div class="wrap">
			<img style="float:left; padding: 8px 12px 4px 4px;"
			     src="<?php echo plugin_dir_url( __FILE__ ); ?>../plugin/images/icon.png"/>
			<h1>Airbrake WordPress</h1>
			<form method="post" action="options.php">
				<?php
				wp_nonce_field( 'update-options' );
				settings_fields('section');
				do_settings_sections('airbrake-plugin-options');

				/*
					<input type="hidden" name="action" value="update"/>
					<input type="hidden"
	                       name="page_options"
	                       value="airbrake_wordpress_setting_status,airbrake_wordpress_setting_apikey,airbrake_wordpress_setting_timeout,airbrake_wordpress_setting_warrings,airbrake_wordpress_setting_async"/>

				*/

				submit_button();
				?>
			</form>
		</div>
		<?php
	}

function display_section_description()
{
	?>
	<p>
		Airbrake is a tool that collects and aggregates errors for web applications. This Plugin makes it simple to track PHP
		errors in your Wordpress install. Once installed it'll collect all errors with the WordPress Core and WordPress
		Plugins.
	</p>

	<p>
		This plugin requires an Airbrake account. Sign up for a
		<a href="https://signup.airbrake.io/account/new?dev=true">Paid</a>
		or a
		<a href="https://signup.airbrake.io/account/new/Free">Free account</a>
		.
	<?php
}

function display_airbrake_wordpress_setting_status()
{
	?>
	<input type="checkbox" name="airbrake_wordpress_setting_status" value="1" <?php checked(1, get_option('display_airbrake_wordpress_setting_status'), true); ?> />
	<?php
}

function display_airbrake_wordpress_setting_apikey()
{
	?>
	<input type="text" name="airbrake_wordpress_setting_apikey" value="<?php echo get_option('airbrake_wordpress_setting_apikey'); ?>" />
	<br/>
	<p>
		<a href="https://signup.airbrake.io/account/new?dev=true">Sign up for an Airbrake API Key</a>
	</p>
	<?php
}

function display_airbrake_wordpress_setting_timeout()
{
	?>
	<input type="text" name="airbrake_wordpress_setting_timeout" value="<?php echo get_option('airbrake_wordpress_setting_timeout'); ?>" />
	<?php
}

function display_airbrake_wordpress_setting_warnings()
{
	?>
	<input type="checkbox" name="airbrake_wordpress_setting_warnings" value="1" <?php checked(1, get_option('airbrake_wordpress_setting_warnings'), true); ?> />
	<br/>
	<p>
		Warning: This option will create a lot of error notification.
	</p>
	<?php
}

function display_airbrake_wordpress_setting_async()
{
	?>
	<input type="checkbox" name="airbrake_wordpress_setting_async" value="1" <?php checked(1, get_option('airbrake_wordpress_setting_async'), true); ?> />
	<?php
}

function display_theme_panel_fields()
{
	add_settings_section('section', 'All Settings', 'display_section_description', 'airbrake-plugin-options');

	add_settings_field('airbrake_wordpress_setting_status', 'Status', 'display_airbrake_wordpress_setting_status', 'airbrake-plugin-options', 'section');
	register_setting('section', 'airbrake_wordpress_setting_status');

	add_settings_field('airbrake_wordpress_setting_apikey', 'API Key', 'display_airbrake_wordpress_setting_apikey', 'airbrake-plugin-options', 'section');
	register_setting('section', 'airbrake_wordpress_setting_apikey');

	add_settings_field('airbrake_wordpress_setting_timeout', 'Timeout', 'display_airbrake_wordpress_setting_timeout', 'airbrake-plugin-options', 'section');
	register_setting('section', 'airbrake_wordpress_setting_timeout');

	add_settings_field('airbrake_wordpress_setting_warnings', 'Enable the logging of warning level messages', 'display_airbrake_wordpress_setting_warnings', 'airbrake-plugin-options', 'section');
	register_setting('section', 'airbrake_wordpress_setting_warnings');

	add_settings_field('airbrake_wordpress_setting_async', 'Asyncronous Notifications', 'display_airbrake_wordpress_setting_async', 'airbrake-plugin-options', 'section');
	register_setting('section', 'airbrake_wordpress_setting_async');
}

add_action('admin_init', 'display_theme_panel_fields');