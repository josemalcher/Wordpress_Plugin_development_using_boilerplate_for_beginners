<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://josemalcher.net/
 * @since      1.0.0
 *
 * @package    Webtutor_wppb01
 * @subpackage Webtutor_wppb01/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Webtutor_wppb01
 * @subpackage Webtutor_wppb01/admin
 * @author     José Malcher Jr <contato@josemalcher.net>
 */
class Webtutor_wppb01_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;
    private $tables;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        require_once CUSTOM_BOILER_PLUGIN_DIR . '/includes/class-webtutor_wppb01-tables.php';
        $this->tables = new Webtutor_wppb01_Tables();

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Webtutor_wppb01_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Webtutor_wppb01_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

//        wp_enqueue_style("bootstrap.min.css", plugin_dir_url(__FILE__) . 'css/bootstrap.min.css', array(), $this->version, 'all');
        wp_enqueue_style("jquery.dataTables.min.css", plugin_dir_url(__FILE__) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all');
        wp_enqueue_style("jquery.notifyBar.css", plugin_dir_url(__FILE__) . 'css/jquery.notifyBar.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/webtutor_wppb01-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Webtutor_wppb01_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Webtutor_wppb01_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script("bootstrap.min.js", plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('jquery'), $this->version, false);//
        wp_enqueue_script("jquery.dataTables.min.js", plugin_dir_url(__FILE__) . 'js/jquery.dataTables.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script("jquery.notifyBar.js", plugin_dir_url(__FILE__) . 'js/jquery.notifyBar.js', array('jquery'), $this->version, false);
        wp_enqueue_script("jquery.validate.min.js", plugin_dir_url(__FILE__) . 'js/jquery.validate.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script("sweetalert.min.js", plugin_dir_url(__FILE__) . 'js/sweetalert.min.js', array('jquery'), $this->version, false);
        //wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/webtutor_wppb01-admin.js', array('jquery'), $this->version, false);
        wp_enqueue_script("webtutor_wppb01-admin.js", plugin_dir_url(__FILE__) . 'js/webtutor_wppb01-admin.js', array('jquery'), $this->version, true);

        //wp_localize_script($this->plugin_name, "custom_ajax_url", admin_url("admin-ajax.php"));
        wp_localize_script("webtutor_wppb01-admin.js", "custom_ajax_url", admin_url("admin-ajax.php"));

    }

    public function custom_ajax_handle_form()
    {
        global $wpdb;
        $param = isset($_REQUEST["param"]) ? $_REQUEST["param"] : "";
        if ($param == "save_user" && !empty($param)) {
            //print_r($_REQUEST);
            /*
             Array
                (
                    [name] => teste
                    [email] => teste@teste.com
                    [telefone] => teste
                    [image-url] => http://localhost/wp-content/uploads/2020/05/scandroid-synthwave.jpg
                    [action] => custom_request
                    [param] => save_user
                )
             * */

            $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : "";
            $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
            $telefone = isset($_REQUEST['telefone']) ? $_REQUEST['telefone'] : "";
            $image_url = isset($_REQUEST['image-url']) ? $_REQUEST['image-url'] : "";

            $wpdb->insert($this->tables->wppb01_Table_alinos(), array(
                "nome" => $name,
                "email" => $email,
                "telefone" => $telefone,
                "image_url" => $image_url,
            ));
            if ($wpdb->insert_id > 0) {
                //echo "Valor inserido com sucesso";
                echo json_encode(array(
                    "status" => 1,
                    "message" => "Dados Salvos com Sucesso"
                ));
            } else {
                //echo "FALHA AO SALVAR SQL";
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Erro ao Salvar"
                ));
            }


            //$this->tables->wppb01_Table_alinos();

        } elseif ($param == "delete_user" && !empty($param)) {
            $data_id = isset($_REQUEST['id']) ? intval($_REQUEST[id]) : 0;
            $is_exists = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM " . $this->tables->wppb01_Table_alinos() . " WHERE id = %d",
                    $data_id
                ), ARRAY_A
            );
            if (!empty($is_exists)) {
                $wpdb->delete($this->tables->wppb01_Table_alinos(), array(
                    "id" => $data_id,
                ));
                echo json_encode(array(
                    "status" => 1,
                    "message" => "Dados Deletado com Sucesso"
                ));
            } else {
                echo json_encode(
                    array(
                        "status" => 0,
                        "message" => "Erro ao salvar, contate o SUPORTE"
                    )
                );
            }
        }
        wp_die();
    }

    public function menus_administrador()
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
            array($this, "func_menu_admin"),
            'dashicons-welcome-widgets-menus',
            90);
        add_submenu_page(
            'menu-admin',
            'My Custom Page',
            'My Custom Page',
            'manage_options',
            'menu-admin',
            array($this, "func_menu_admin"));
        add_submenu_page(
            'menu-admin',
            'My Custom Submenu Page',
            'My Custom Submenu Page',
            'manage_options',
            'my-secondary-slug',
            array($this, "func_menu_2"));
    }

    //add_action( 'admin_menu', 'menus_administrador' );


    public function func_menu_admin()
    {
        include_once CUSTOM_BOILER_PLUGIN_DIR . "/admin/partials/webtutor_wppb01-admin-list.php";
    }

    public function func_menu_2()
    {
        include_once CUSTOM_BOILER_PLUGIN_DIR . "/admin/partials/webtutor_wppb01-admin-add.php";
    }


}
