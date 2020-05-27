<?php

if (!defined('ABSPATH')) exit;

class TekcertoCertificado
{
    private static $instancia;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $nomeClasse = __CLASS__;
            self::$instancia = new $nomeClasse;
        }
        return self::$instancia;
    }

    private function __construct()
    {
        add_action('admin_enqueue_scripts', array(&$this, 'scripts_admin'));
        add_action( 'wp_enqueue_scripts', array(&$this, 'scripts'));
        add_action('init', array(&$this, 'registra_categoria'), 1);
        add_action('add_meta_boxes', array(&$this, 'meta_boxes'));
        add_action('save_post', array(&$this, 'salva_meta_box'), 9, 1);
        add_action('save_post', array(&$this, 'salva_configuracao_meta_box'), 9, 1);
    }

    public function scripts_admin()
    {
        if (get_post_type() == "tekcerto_certificado") {
            wp_enqueue_style('bootstrap', TEKCERTO_CERTIFICADO_DIR . 'lib/css/bootstrap.min.css');
        }
    }
    public function scripts(){
        wp_enqueue_script("jquery");
        wp_enqueue_script("jquery-ui-dialog");
        wp_enqueue_style("wp-jquery-ui-dialog");
    }

    public function registra_categoria()
    {
        require_once('categoria_post.php');
        add_filter('manage_edit-tekcerto_certificado_columns', array(&$this, 'coluna_shortcode'));
        add_action('manage_tekcerto_certificado_posts_custom_column', array(&$this, 'linha_shortcode'), 10, 2);
    }


    function coluna_shortcode($columns)
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => 'Certificados',
            'shortcode' => 'Certificados Shortcode',
            'date' => 'Data'
        );
        return $columns;
    }

    function linha_shortcode($column, $post_id)
    {
        global $post;
        switch ($column) {
            case 'shortcode':
                echo '<input style="width:225px" type="text" value="[TEKCERTO_CERTIFICADO id=' . $post_id . ']" readonly="readonly" />';
                break;
            default:
                break;
        }
    }


    public function meta_boxes()
    {
        add_meta_box('add_tekcerto_certificado_texto', 'Formulário para o Certificado', array(&$this, 'boxe_texto'), 'tekcerto_certificado', 'normal', 'low');
    }

    public function boxe_texto($post)
    {
        require_once('box.php');
    }

    public function salva_meta_box($PostID)
	{
		require('salva_dados.php');
    }
    
    
	public function servicebox_settings_meta_box_save($PostID)
	{
		require('salva_configuracao.php');
	}

}
global $tekcerto_certificado;
$tekcerto_certificado = TekcertoCertificado::getInstancia();
