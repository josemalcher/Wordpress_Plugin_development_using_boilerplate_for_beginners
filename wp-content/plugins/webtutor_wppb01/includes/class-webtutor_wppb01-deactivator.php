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
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Webtutor_wppb01
 * @subpackage Webtutor_wppb01/includes
 * @author     José Malcher Jr <contato@josemalcher.net>
 */
class Webtutor_wppb01_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function deactivate() {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS " . $this->table_aluno());
	}

    private function table_aluno()
    {
        global $wpdb;
        return $wpdb->prefix . "alunos";
    }

}
