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
class Webtutor_wppb01_Deactivator
{

    private $table;

    /**
     * Webtutor_wppb01_Activator constructor.
     */
    public function __construct($tables_obj)
    {
        $this->table = $tables_obj;
    }

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public function deactivate()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS " . $this->table->wppb01_Table_alinos());

        $this->pagina_personalizada_del();
    }

    private function pagina_personalizada_del()
    {
        if (!empty(get_option("pagina_personalizada"))) {
            $page_id = get_option("pagina_personalizada");
            wp_delete_post($page_id, true);
            delete_option("pagina_personalizada");
        }
    }

}
