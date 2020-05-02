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
    <div class="row">

        <h1>Adicionar Item</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">Panel with panel-primary class</div>
            <div class="panel-body">

                <form class="form-horizontal" action="javascript:void(0)" id="frmAddPlayList">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" required name="name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" required name="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telefone" required name="telefone" placeholder="Enter Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Photo</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="photo" required name="photo" placeholder="Enter Photo">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Salvar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
