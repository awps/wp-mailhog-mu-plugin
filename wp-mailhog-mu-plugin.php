<?php
/**
 * Plugin Name: WP Mailhog MU Plugin
 * Plugin URI:  https://zerowp.com/
 * Description: WordPress Mailhog MU Plugin. Designed to be used in tandem with docker-compose.
 * Author:      Andrei Surdu
 * Author URI:  http://zerowp.com/
 * Version:     1.0.0
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Requires PHP: 7.1
 * Requires at least: 5.0
 */

add_action('phpmailer_init', 'awps_wp_mailhog_mu_plugin_setup');
function awps_wp_mailhog_mu_plugin_setup(\PHPMailer\PHPMailer\PHPMailer $phpmailer)
{
    $phpmailer->Host = 'mailhog';
    $phpmailer->Port = 1025;
    $phpmailer->IsSMTP();
}
