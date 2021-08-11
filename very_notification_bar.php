<?php
/*
 * Plugin Name:       Very Notification Bar
 * Plugin URI:        https://
 * Description:       Ajoutez une barre de notification à votre site web, pour mettre en évidence une promotion ou faire passer un message. 
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      5.2
 * Author:            Simafri
 * Author URI:        https://
 * License:           GPLv2 o
 * License URI:       https://
 * Text Domain:       notification_bar
 * Domain Path:       /languages
*/

require_once plugin_dir_path(__FILE__) . 'includes/very_notification_bar_function.php';

//make plugin multilingual
add_action('plugins_loaded', 'multilingual_notification_bar'); 
function multilingual_notification_bar() 
{
	load_plugin_textdomain( 'notification_bar', 
                            false, 
                            dirname(plugin_basename(__FILE__)).'/languages'
                        );
}
 


