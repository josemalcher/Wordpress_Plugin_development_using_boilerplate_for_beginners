# Wordpress Plugin development using boilerplate for beginners

https://www.youtube.com/playlist?list=PLT9miexWCpPUwGlFk_yIH2cdkDgJDvRBn

## <a name="indice">Índice</a>

1. [Boilerplate introduction, features..](#parte1)     
2. [About Folder Structure Information](#parte2)     
3. [Create & Drop tables by Plugin](#parte3)     
4. [Menus & Submenus by using Root File](#parte4)     
5. [Callback functions of menus,submenus](#parte5)     
6. [Assets file linking to plugin](#parte6)     
7. [Layout Settings of pages of plugin](#parte7)     
8. [Media Image Upload in Plugin](#parte8)     
9. [Process AJAX REQUEST using wp_ajax](#parte9)     
10. [Render Plugin data to page | show](#parte10)     
11. [Delete Plugin Table Data](#parte11)     
12. [How to use PHP Buffers](#parte12)     
13. [Create dynamic page by plugin](#parte13)     
14. [Assign template to Dynamic page](#parte14)     
15. [About get_var, get_row, get_results](#parte15)     
16. [Different ways to get user data](#parte16)     
---


## <a name="parte1">1 - Boilerplate introduction, features..</a>

- https://wppb.me/

- wp-content/plugins/webtutor_wppb01

[Voltar ao Índice](#indice)

---


## <a name="parte2">2 - About Folder Structure Information</a>

admin
=============
Existem três diretórios contidos no diretório admin, ou seja, css,
js e parciais. Como o próprio nome sugere, todas as funcionalidades voltadas para o administrador devem
 ser colocado aqui. Por padrão, o plugin-name-admin.js e o plugin-name-admin.css
 está enfileirado no seu wp-admin. O class-plugin-name-admin.php fornecerá
 funcionalidade genérica em que você pode definir seus ganchos específicos para administradores.

public
==============
Esse diretório é muito parecido com o que o diretório admin precisa
oferta, a única diferença é que o diretório público deve ser usado para
armazene toda a sua base de código de funcionalidade voltada para o público.

languages
==========
Um arquivo .pot inicial no qual você pode fornecer a funcionalidade de tradução com
seu plugin.

includes
=============
Provavelmente é aqui que praticamente toda a magia acontece. Há cinco
iniciando classes incluídas por padrão.

LICENSE.txt
==========
Uma cópia da licença GPL v2 é incluída por padrão.

README.txt
============
Um ponto de partida para o arquivo LEIA-ME do plug-in. Este arquivo abrange todos os
as seções que você pode preencher para fornecer uma boa página de plug-in
Repositório de plugins do WordPress.

plugin-name.php
===============
O ponto de entrada para o seu plugin. Aqui, um cabeçalho geral do arquivo de plug-in é
incluído que você pode modificar conforme seu gosto. O registo_activação_hook
e register_deactivation_hook também são registrados neste arquivo se você alguma vez
precisa incluir algum tipo de funcionalidade na ativação do plug-in e / ou
desativação.

Classes incluídas
Como mencionado anteriormente, há cinco classes padrão fornecidas dentro do
/ inclui diretório. Vamos ver o que cada um deles faz:

class-plugin-name-activator.php
=========================================
Essa classe é instanciada durante a ativação do plug-in. Possui apenas uma estática
método, enable () que é registrado no register_activation_hook.
Use esta classe sempre que precisar fazer algo no plugin
ativação, como criar tabelas personalizadas ou salvar opções padrão.

class-plugin-name-deactivator.php
===================================
A contrapartida de class-plugin-name-deactivator.php. Ele também contém apenas
 um método estático, deactivate (), que pode ser usado para executar qualquer funcionalidade
 durante a desativação do plug-in.

class-plugin-name.php
===========================
A classe que cola todas as peças juntas. Contém informações importantes
sobre o plug-in, como o nome e a versão do plug-in. Além disso, ele carregará
 as dependências usando o método load_dependencies () que incluirá
 todas as quatro classes acima e o domínio de texto do plug-in serão definidos usando
 método set_locale (). Todos os ganchos administrativos e públicos que eram anteriormente
 registrado também pode ser definido aqui.

FONTE: https://www.youtube.com/watch?v=osAEmNsIi80



[Voltar ao Índice](#indice)

---


## <a name="parte3">3 - Create & Drop tables by Plugin</a>


```php
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-webtutor_wppb01-activator.php
 */
function activate_webtutor_wppb01() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webtutor_wppb01-activator.php';
	//Webtutor_wppb01_Activator::activate();
    $activator = new Webtutor_wppb01_Activator();
    $activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-webtutor_wppb01-deactivator.php
 */
function deactivate_webtutor_wppb01() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webtutor_wppb01-deactivator.php';
	//Webtutor_wppb01_Deactivator::deactivate();
    $deactivador = new Webtutor_wppb01_Deactivator();
    $deactivador->deactivate();
}
```

- [includes/class-webtutor_wppb01-activator.php](wp-content/plugins/webtutor_wppb01/includes/class-webtutor_wppb01-activator.php)
- [includes/class-webtutor_wppb01-deactivator.php](wp-content/plugins/webtutor_wppb01/includes/class-webtutor_wppb01-deactivator.php)



[Voltar ao Índice](#indice)

---


## <a name="parte4">4 - Menus & Submenus by using Root File</a>

- [wp-content/plugins/webtutor_wppb01/webtutor_wppb01.php](wp-content/plugins/webtutor_wppb01/webtutor_wppb01.php)

```php
function menus_administrador()
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
        'func_menu_admin',
        'dashicons-welcome-widgets-menus',
        90 );
    add_submenu_page(
        'menu-admin',
        'My Custom Page',
        'My Custom Page',
        'manage_options',
        'menu-admin',
    "func_menu_admin");
    add_submenu_page(
        'menu-admin',
        'My Custom Submenu Page',
        'My Custom Submenu Page',
        'manage_options',
        'my-secondary-slug',
        "func_menu_2");
}
add_action( 'admin_menu', 'menus_administrador' );

```

[Voltar ao Índice](#indice)

---


## <a name="parte5">5 - Callback functions of menus,submenus</a>

- [wp-content/plugins/webtutor_wppb01/webtutor_wppb01.php](wp-content/plugins/webtutor_wppb01/webtutor_wppb01.php)

```php

if(!defined("CUSTOM_BOILER_PLUGIN_DIR")){
    define("CUSTOM_BOILER_PLUGIN_DIR", plugin_dir_path(__FILE__));
}
if(!defined("CUSTOM_BOILER_PLUGIN_URL")){
    define("CUSTOM_BOILER_PLUGIN_URL", plugins_url()."/webtutor_wppb01");
}
```

- [wp-content/plugins/webtutor_wppb01/admin/class-webtutor_wppb01-admin.php](wp-content/plugins/webtutor_wppb01/admin/class-webtutor_wppb01-admin.php)

- wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-list.php
- wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-add.php

```php

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
    //add_action( 'admin_menu', 'menus_administrador' ); -> define_admin_hooks() 



    public function func_menu_admin(){
        include_once CUSTOM_BOILER_PLUGIN_DIR. "/admin/partials/webtutor_wppb01-admin-list.php";
    }
    public function func_menu_2(){
        include_once  CUSTOM_BOILER_PLUGIN_DIR. "/admin/partials/webtutor_wppb01-admin-add.php";
    }
```

- [wp-content/plugins/webtutor_wppb01/includes/class-webtutor_wppb01.php](wp-content/plugins/webtutor_wppb01/includes/class-webtutor_wppb01.php)

```php
private function define_admin_hooks() {

		$plugin_admin = new Webtutor_wppb01_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		//menu custom action
        $this->loader->add_action( 'admin_menu',$plugin_admin, 'menus_administrador' );
	}

```



[Voltar ao Índice](#indice)

---


## <a name="parte6">6 - Assets file linking to plugin</a>

- [wp-content/plugins/webtutor_wppb01/admin/class-webtutor_wppb01-admin.php](wp-content/plugins/webtutor_wppb01/admin/class-webtutor_wppb01-admin.php)

```php
public function enqueue_styles()
    {
        //wp_enqueue_style("bootstrap.min.css", plugin_dir_url(__FILE__) . 'css/bootstrap.min.css', array(), $this->version, 'all');
        wp_enqueue_style("jquery.dataTables.min.css", plugin_dir_url(__FILE__) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all');
        wp_enqueue_style("jquery.notifyBar.css", plugin_dir_url(__FILE__) . 'css/jquery.notifyBar.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/webtutor_wppb01-admin.css', array(), $this->version, 'all');

    }

    public function enqueue_scripts()
    {
        wp_enqueue_script("bootstrap.min.js", plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('jquery'), $this->version, false);//
        wp_enqueue_script("jquery.dataTables.min.js", plugin_dir_url(__FILE__) . 'js/jquery.dataTables.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script("jquery.notifyBar.js", plugin_dir_url(__FILE__) . 'js/jquery.notifyBar.js', array('jquery'), $this->version, false);
        wp_enqueue_script("jquery.validate.min.js", plugin_dir_url(__FILE__) . 'js/jquery.validate.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/webtutor_wppb01-admin.js', array('jquery'), $this->version, false);

    }
```

[Voltar ao Índice](#indice)

---


## <a name="parte7">7 - Layout Settings of pages of plugin</a>

- [wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-list.php](wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-list.php)
- [wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-add.php](wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-add.php)


- [wp-content/plugins/webtutor_wppb01/admin/js/webtutor_wppb01-admin.js](wp-content/plugins/webtutor_wppb01/admin/js/webtutor_wppb01-admin.js)

```js
(function( $ ) {
	'use strict';

	$(document).ready(function() {
		$('#example').DataTable();
		$('#frmAddPlayList').validate({
			submitHandler:function () {

			}
		});
	} );



})( jQuery );




```

[Voltar ao Índice](#indice)

---


## <a name="parte8">8 - Media Image Upload in Plugin</a>

- [wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-add.php](wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-add.php)

```php
<?php

wp_enqueue_media();

?>
<div class="form-group">
    <label class="control-label col-sm-2">Photo</label>
    <div class="col-sm-10">
        <!--<input type="file" class="form-control" id="photo" required name="photo" placeholder="Enter Photo">-->
        <button class="btn btn-info" id="media_photo">Add Photo</button>
        <span><img src="" alt="" id="media-img" style="height: 100px; width: 100px"></span>
        <input type="hidden" id="image-url" name="image-url">
    </div>
</div>
```

- [wp-content/plugins/webtutor_wppb01/admin/js/webtutor_wppb01-admin.js](wp-content/plugins/webtutor_wppb01/admin/js/webtutor_wppb01-admin.js)

```js

		$('#media_photo').on("click", function () {
			var image = wp.media({
				title: "Upload Image for Modelo",
				multiple: false
				//multiple: true
			}).open().on("select", function () {
				var files = image.state().get("selection").first();// uma imagem
				//var files = image.state().get("selection");
				var jsonFiles = files.toJSON();
				//console.log(jsonFiles);
				/*
				$.each(jsonFiles, function (index, item) {
					console.log(item.title);
				});
				*/
				$("#media-img").attr("src", jsonFiles.url);
				$("#image-url").val(jsonFiles.url);
			});
		});
```

[Voltar ao Índice](#indice)

---


## <a name="parte9">9 - Process AJAX REQUEST using wp_ajax</a>

- [wp-content\plugins\webtutor_wppb01\includes\class-webtutor_wppb01.php](wp-content\plugins\webtutor_wppb01\includes\class-webtutor_wppb01.php)

```php
private function define_admin_hooks() {

// (...)

        // ajax request handle
        $this->loader->add_action("wp_ajax_custom_request",$plugin_admin, 'custom_ajax_handle_form' );
}
```

- [wp-content/plugins/webtutor_wppb01/admin/class-webtutor_wppb01-admin.php](wp-content/plugins/webtutor_wppb01/admin/class-webtutor_wppb01-admin.php)

```php

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

            $name =      isset($_REQUEST['name']) ? $_REQUEST['name'] : "";
            $email =     isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
            $telefone =  isset($_REQUEST['telefone']) ? $_REQUEST['telefone'] : "";
            $image_url = isset($_REQUEST['image-url']) ? $_REQUEST['image-url'] : "";

            $wpdb->insert($this->tables->wppb01_Table_alinos(), array(
                "nome" => $name,
                "email" => $email,
                "telefone" => $telefone,
                "image_url" => $image_url,
            ));
            if ($wpdb->insert_id > 0) {
                echo "Valor inserido com sucesso";
            } else {
                echo "FALHA AO SALVAR SQL";
            }


            //$this->tables->wppb01_Table_alinos();

        }
        wp_die();
    }
```
- [wp-content/plugins/webtutor_wppb01/admin/js/webtutor_wppb01-admin.js](wp-content/plugins/webtutor_wppb01/admin/js/webtutor_wppb01-admin.js)

```js
$('#frmAddPlayList').validate({
            submitHandler: function () {
                let post_data = $("#frmAddPlayList").serialize() + "&action=custom_request&param=save_user";
                //console.log(post_data);
                $.post(custom_ajax_url, post_data, function (response) {
                    console.log(response);

                });
            }
        });
```

[Voltar ao Índice](#indice)

---


## <a name="parte10">10 - Render Plugin data to page | show</a>

- [wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-list.php](wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-list.php)

```php
global $wpdb;
$all_users = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM " . $this->tables->wppb01_Table_alinos() . " ORDER BY %s DESC",
        "id"), ARRAY_A
);
```

[Voltar ao Índice](#indice)

---


## <a name="parte11">11 - Delete Plugin Table Data</a>

```html
    <a href="javascript:void(0)" 
        class="btn btn-danger cdelete" data-id="<?= $data['id']; ?>">
    <i class="dashicons-before dashicons-trash"></i></a>
```

```js
$(".cdelete").on("click", function () {
            let data_id = $(this).attr("data-id");
            //console.log(data_id);
            let post_data = "action=custom_request&param=delete_user&id="+ data_id;
            var conf = confirm("Tem certeza que quer apagar?");
            if (conf) {
                $.post(custom_ajax_url, post_data, function (response) {
                    var data = $.parseJSON(response);
                    //data.status
                    //data.message
                    if (data.status == 1) {
                        swal(data.message, "", "success");
                        setTimeout(function () {
                            location.reload();
                        }, 2000);

                    } else {
                        swal(data.message, "Entre em Contato com Suporte", "error");
                    }
                    //location.reload();
                });
            }
        })
```

```php
 elseif ($param == "delete_user" && !empty($param)) {
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
```

[Voltar ao Índice](#indice)

---


## <a name="parte12">12 - How to use PHP Buffers</a>

- [wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-list.php](wp-content/plugins/webtutor_wppb01/admin/partials/webtutor_wppb01-admin-list.php)

```html
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
```

- [wp-content/plugins/webtutor_wppb01/admin/partials/tmpl/list_user.php](wp-content/plugins/webtutor_wppb01/admin/partials/tmpl/list_user.php)

```php
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
```


- [wp-content/plugins/webtutor_wppb01/admin/class-webtutor_wppb01-admin.php](wp-content/plugins/webtutor_wppb01/admin/class-webtutor_wppb01-admin.php)

```php
if (!empty($is_exists)) {
                $wpdb->delete($this->tables->wppb01_Table_alinos(), array(
                    "id" => $data_id,
                ));

                // START
                ob_start();
                include_once CUSTOM_BOILER_PLUGIN_DIR."/admin/partials/tmpl/list_user.php";
                $template = ob_get_contents();
                //END
                ob_end_clean();

                echo json_encode(array(
                    "status" => 1,
                    "message" => "Dados Deletado com Sucesso",
                    "template" => $template
                ));
            } else {
                echo json_encode(
                    array(
                        "status" => 0,
                        "message" => "Erro ao salvar, contate o SUPORTE"
                    )
                );
            }
```

- [wp-content/plugins/webtutor_wppb01/admin/js/webtutor_wppb01-admin.js](wp-content/plugins/webtutor_wppb01/admin/js/webtutor_wppb01-admin.js)

```js
$.post(custom_ajax_url, post_data, function (response) {
                    var data = $.parseJSON(response);
                    //data.status
                    //data.message
                    if (data.status == 1) {
                        swal(data.message, "", "success");
                        setTimeout(function () {
                            location.reload();
                        }, 2000);

                        //$("#table-users").html(data.template); // no curso é dado assim! Preferir manter
                        //location.reload();

                    } else {
                        swal(data.message, "Entre em Contato com Suporte", "error");
                    }
                    //location.reload();
                });
```



[Voltar ao Índice](#indice)

---


## <a name="parte13">13 - Create dynamic page by plugin</a>

- [wp-content/plugins/webtutor_wppb01/includes/class-webtutor_wppb01-activator.php](wp-content/plugins/webtutor_wppb01/includes/class-webtutor_wppb01-activator.php)

```php
    public function activate()
    {
        // (...)
        
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
```

- [wp-content/plugins/webtutor_wppb01/includes/class-webtutor_wppb01-deactivator.php](wp-content/plugins/webtutor_wppb01/includes/class-webtutor_wppb01-deactivator.php)

```php
    public function deactivate()
    {
        // (...)
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
```

[Voltar ao Índice](#indice)

---


## <a name="parte14">14 - Assign template to Dynamic page</a>

- [wp-content/plugins/webtutor_wppb01/includes/class-webtutor_wppb01.php](wp-content/plugins/webtutor_wppb01/includes/class-webtutor_wppb01.php)

```php
    private function define_public_hooks() {

	    // (...)


		$this->loader->add_filter("page_template", $plugin_public, "gerador_page_template");

		add_shortcode("teste_shortcode", array($plugin_public, "front_end_teste_page_01"));
	}
```

- [wp-content/plugins/webtutor_wppb01/public/class-webtutor_wppb01-public.php](wp-content/plugins/webtutor_wppb01/public/class-webtutor_wppb01-public.php)

```php

    public function gerador_page_template()
    {
        global $post;
        $post_slug = $post->post_name;
        if ($post_slug == "teste-page-01") {
            $page_template = CUSTOM_BOILER_PLUGIN_DIR. "/public/partials/front-end-teste-page-01.php";
        }
        return $page_template;
    }

    public function front_end_teste_page_01()
    {
        //echo "Aqui é um SHORT CODE";
        include_once CUSTOM_BOILER_PLUGIN_DIR. "/public/partials/front-end-teste-page-call-page.php";
    }
```
- [wp-content/plugins/webtutor_wppb01/public/partials/front-end-teste-page-01.php](wp-content/plugins/webtutor_wppb01/public/partials/front-end-teste-page-01.php)

- [wp-content/plugins/webtutor_wppb01/public/partials/front-end-teste-page-call-page.php](wp-content/plugins/webtutor_wppb01/public/partials/front-end-teste-page-call-page.php)


[Voltar ao Índice](#indice)

---


## <a name="parte15">15 - About get_var, get_row, get_results</a>

```php
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
```

[Voltar ao Índice](#indice)

---


## <a name="parte16">16 - Different ways to get user data</a>



[Voltar ao Índice](#indice)

---
