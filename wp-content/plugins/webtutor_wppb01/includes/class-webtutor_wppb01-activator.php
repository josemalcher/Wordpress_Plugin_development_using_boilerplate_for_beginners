<?php

/**
 * Fired during plugin activation
 *
 * @link       https://josemalcher.net/
 * @since      1.0.0
 *
 * @package    Webtutor_wppb01
 * @subpackage Webtutor_wppb01/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Webtutor_wppb01
 * @subpackage Webtutor_wppb01/includes
 * @author     José Malcher Jr <contato@josemalcher.net>
 */
class Webtutor_wppb01_Activator
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
    public function activate()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;
        $table_total = $wpdb->get_var("SHOW TABLES LIKE '" . $this->table->wppb01_Table_alinos() . "'");
        if (empty($table_total)) {
            $sqlQuery = "CREATE TABLE `".$this->table->wppb01_Table_alinos() ."`
                            (
                                `id` int NOT NULL AUTO_INCREMENT,
                                `nome` varchar(200) null,
                                `email` varchar(200) null,
                                `telefone` varchar(20) null,
                                    PRIMARY KEY (`id`)
                            )";
            dbDelta($sqlQuery);
        }
        $this->pagina_personalizada();
    }

    private function pagina_personalizada()
    {
        global $wpdb;
        $is_slug_exists = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM ". $wpdb->prefix . "posts 
                        WHERE post_name = %s", "teste-page-01"
            ), ARRAY_A
        );

        if (empty($is_slug_exists)) {
            $page = array();
            $page['post_title'] = "Teste Page 1";
            $page['post_content'] = "COnteudo da página <strong>TESTE</strong>";
            $page['post_status'] = "publish";
            $page['post_name'] = "teste-page-01";
            $page['post_type'] = "page";
            $post_id = wp_insert_post($page);
            add_option("pagina_personalizada", $post_id);
        }else{

        }


    }

}

