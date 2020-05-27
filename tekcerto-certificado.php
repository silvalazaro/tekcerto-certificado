<?php
/**
 * Plugin Name: Tekcerto Certificado
 * Plugin URI: http://wordpress.tekcerto.com.br/plugin/certificado
 * Description: Plugin wordpress para gerar certificado de curso ou treinamento em PDF. Com envio automático de e-mail.
 * Version: 1.0
 * Author: Lázaro Silva
 * Author URI: http://wordpress.tekcerto.com.br
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'TEKCERTO_CERTIFICADO_DIR') ) 
    define( 'TEKCERTO_CERTIFICADO_DIR', plugin_dir_url(__FILE__));

require_once("admin/TekcertoCertificado.php");

require_once("template/shortcode.php"); 