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
global $wpdb;
$all_users = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM " . $this->tables->wppb01_Table_alinos() . " ORDER BY %s DESC",
        "id"), ARRAY_A
);

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
                <tbody>
                <?php
                if (count($all_users) > 0) {
                    foreach ($all_users as $indes => $data) {
                        ?>
                        <tr>
                            <td><?= $data['id']; ?></td>
                            <td><?= $data['nome']; ?></td>
                            <td><?= $data['email']; ?></td>
                            <td><?= $data['telefone']; ?></td>
                            <td><img src="<?= $data['image_url']; ?>" alt="" style="width: 150px; height: 100px"></td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info"><i
                                            class="dashicons-before dashicons-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger"><i
                                            class="dashicons-before dashicons-trash"></i></a>

                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<h3>Não há dados</h3>";
                }
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