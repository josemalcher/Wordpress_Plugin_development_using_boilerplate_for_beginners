<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://josemalcher.net/
 * @since      1.0.0
 *
 * @package    Webtutor_wppb01
 * @subpackage Webtutor_wppb01/includes
 */

/**
 * File contains definicion of tables section
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Webtutor_wppb01
 * @subpackage Webtutor_wppb01/includes
 * @author     José Malcher Jr <contato@josemalcher.net>
 */
class Webtutor_wppb01_Tables {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public function wppb01_Table_alinos()
    {
        global $wpdb;
        return $wpdb->prefix . "alunos";
    }
}
