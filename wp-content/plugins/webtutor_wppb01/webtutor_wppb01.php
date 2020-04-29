<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://josemalcher.net/
 * @since             1.0.0
 * @package           Webtutor_wppb01
 *
 * @wordpress-plugin
 * Plugin Name:       webtutor_wppb01
 * Plugin URI:        https://josemalcher.net/webtutor_wppb01
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            José Malcher Jr
 * Author URI:        https://josemalcher.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       webtutor_wppb01
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WEBTUTOR_WPPB01_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-webtutor_wppb01-activator.php
 */
function activate_webtutor_wppb01()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-webtutor_wppb01-tables.php';
    $tables = new Webtutor_wppb01_Tables();

    require_once plugin_dir_path(__FILE__) . 'includes/class-webtutor_wppb01-activator.php';
    //Webtutor_wppb01_Activator::activate();
    $activator = new Webtutor_wppb01_Activator($tables);
    $activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-webtutor_wppb01-deactivator.php
 */
function deactivate_webtutor_wppb01()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-webtutor_wppb01-tables.php';
    $tables = new Webtutor_wppb01_Tables();

    require_once plugin_dir_path(__FILE__) . 'includes/class-webtutor_wppb01-deactivator.php';
    //Webtutor_wppb01_Deactivator::deactivate();
    $deactivador = new Webtutor_wppb01_Deactivator($tables);
    $deactivador->deactivate();
}

register_activation_hook(__FILE__, 'activate_webtutor_wppb01');
register_deactivation_hook(__FILE__, 'deactivate_webtutor_wppb01');



function menus_administrador()
{
    /*
     *
     * add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
     * */
    add_menu_page(
        'Custom Menu Page Title',
        'Custom Menu Page',
        'manage_options',
        'menu-admin',
        'func_menu_admin',
        'dashicons-welcome-widgets-menus',
        90 );
    add_submenu_page(
        'menu-admin',
        'My Custom Page',
        'My Custom Page',
        'manage_options',
        'menu-admin',
    "func_menu_admin");
    add_submenu_page(
        'menu-admin',
        'My Custom Submenu Page',
        'My Custom Submenu Page',
        'manage_options',
        'my-secondary-slug',
        "func_menu_2");
}
add_action( 'admin_menu', 'menus_administrador' );

function func_menu_admin(){
    return "page 1";
}
function func_menu_2(){
    return "page 2";
}


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-webtutor_wppb01.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_webtutor_wppb01()
{

    $plugin = new Webtutor_wppb01();
    $plugin->run();

}

run_webtutor_wppb01();
