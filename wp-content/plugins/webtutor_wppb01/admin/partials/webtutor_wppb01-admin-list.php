<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://josemalcher.net/
 * @since      1.0.0
 *
 * @package    Webtutor_wppb01
 * @subpackage Webtutor_wppb01/admin/partials
 */

wp_enqueue_style("bootstrap.min.css", plugin_dir_url(__FILE__) . '../css/bootstrap.min.css', array(), $this->version, 'all');


?>
<div class="container">
    <h2>Dados Cadatrados</h2>
    <small>Dados cadastrados ...</small>
    <hr>
</div>

<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">Lista de Itens ...</div>
        <div class="panel-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                <tr>
                    <th class=" column-id">id</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody id="table-users">
                    <?php
                    ob_start(); // start the buffer
                    include_once CUSTOM_BOILER_PLUGIN_DIR."/admin/partials/tmpl/list_user.php";

                    // read buffer
                    $template = ob_get_contents();

                    //closer the buffer
                    ob_end_clean();

                    echo $template;
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>id</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>