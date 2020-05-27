<?php
if (!defined('ABSPATH')) exit;
$labels = array(
	'name'                => 'Tekcerto Certificado',
	'singular_name'       => 'Certificado',
	'menu_name'           => 'Tekcerto Certificado',
	'parent_item_colon'   => 'Ascendente',
	'all_items'           => 'Todos',
	'view_item'           => 'Ver Certificado',
	'add_new_item'        => 'Adicionar Novo Certificado',
	'add_new'             => 'Adicionar Novo Certificado',
	'edit_item'           => 'Editar Certificado',
	'update_item'         => 'Atualizar Certificado',
	'search_items'        => 'Buscar Certificado',
	'not_found'           => 'Certificado não encontrado',
	'not_found_in_trash'  => 'Nenhum certificado encontrada na lixeira',
);
$args = array(
	'label'               => 'Tekcerto Certificado Paineis',
	'description'         => 'Tekcerto Certificado Painel',
	'labels'              => $labels,
	'supports'            => array('title', '', '', '', '', '', '', '', '', '', '',),
	//'taxonomies'          => array( 'category', 'post_tag' ),
	'hierarchical'        => false,
	'public'              => false,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => false,
	'show_in_admin_bar'   => false,
	'menu_position'       => 5,
	'menu_icon'           => 'dashicons-admin-tools',
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => false,
	'capability_type'     => 'page',
);
register_post_type('tekcerto_certificado', $args);
