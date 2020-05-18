<?php
global $wpdb;
$all_users = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM " . $this->tables->wppb01_Table_alinos() . " ORDER BY %s DESC",
        "id"), ARRAY_A
);
if (count($all_users) > 0) {
    foreach ($all_users as $index => $data) {
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
                <a href="javascript:void(0)"
                   class="btn btn-danger cdelete" data-id="
                                            <?= $data['id']; ?>"><i class="dashicons-before dashicons-trash"></i></a>

            </td>
        </tr>
        <?php
    }
} else {
    echo "<h4>Não há dados</h4>";
}
?>
