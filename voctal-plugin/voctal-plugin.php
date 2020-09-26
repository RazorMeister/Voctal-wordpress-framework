<?php
/**
 * Plugin Name: Voctal framework sample plugin
 * Plugin URI: https://github.com/RazorMeister/Voctal-wordpress-framework
 * Description: Simple example plugin.
 * Version: BETA
 *
 * Text Domain: voctal-plugin
 * Domain Path: /languages
 *
 * Author: Tymoteusz `RazorMeister` Bartnik & Przemysław `lavar3l` Dominikowski
 * Author URI: http://razormeister.pl
 *
 * License: European Union Public Licence v. 1.2
 * License URI: https://github.com/RazorMeister/Maintenance-Mode-Wordpress-Plugin/blob/master/LICENSE.md
 */

require_once(dirname(__FILE__).'/framework/VoctalFramework.php');

/* Init Voctal framework */
$voctalFramework = new \VoctalFramework\VoctalFramework();

/* Set plugin information */
$data = [
    'name' => 'Voctal plugin',
    'slug' => 'voctal-plugin',
    'prefix' => 'vp_',
    'assets' => 'assets',
    'version' => '0.2',
    'author' => 'Jan Kowalski',
    'url' => plugin_dir_url(__FILE__),
    'viewsPath' => 'inc/Admin/Views',
    'path' => dirname(__FILE__),
];

$voctalFramework->setPluginData($data);

$voctalFramework->setPluginAutoLoader(dirname(__FILE__).'/inc', 'VoctalPlugin');


$init = new \VoctalPlugin\Init($voctalFramework);