<?php
get_header();

global $wpdb;
?>
    <div class="container">
        <div class="row">
            <h4> 15 - About get_var, get_row, get_results</h4>
        </div>
        <div class="row">
            <p>Return results onf whole db table ARRAY_A, ARRAY_N, Object</p>
            <?php
            $users_detalhes = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT * FROM " . $wpdb->prefix . "users ORDER BY %s DESC", "id"
                ), ARRAY_A
            );
            ?>
            <pre>
            <?php
                print_r($users_detalhes);
            ?>
            </pre>
        </div>

        <div class="row">
            <p>Return the row of DB</p>
            <?php
            $users_detalhes_2 = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM " . $wpdb->prefix . "users WHERE id = %d", 2
                )
            );
            ?>
            <pre>
            <?php
            print_r($users_detalhes_2);
            ?>
            </pre>
        </div>

        <div class="row">
            <p>Return a single value row of DB</p>
            <?php
            $users_detalhes_3 = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT user_email FROM " . $wpdb->prefix . "users WHERE id = %d", 2
                )
            );
            ?>
            <pre>
            <?php
            print_r($users_detalhes_3);
            ?>
            </pre>
        </div>
    </div>
<?php
get_footer();
?>