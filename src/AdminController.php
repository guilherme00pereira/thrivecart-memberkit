<?php

namespace G28\ThriveCartMemberKit;

class AdminController {

	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
	}

	public function add_admin_menu(): void
    {
		add_menu_page(
			'ThriveCart MemberKit',
			'ThriveCart MemberKit',
			'manage_options',
			'thrivecart-memberkit',
			array( $this, 'admin_page' ),
			'dashicons-admin-generic',
			6
		);
	}

	public function admin_page(): void
    {
        ob_start();
        include_once sprintf("%sadmin-page.php", Plugin::getTemplateDir());
        echo ob_get_clean();
	}

    public function enqueue_scripts()
    {
        wp_enqueue_style(
            Plugin::getAssetsPrefix() . 'admin-style',
            Plugin::getAssetsUrl() . 'assets/css/admin.css'
        );
        wp_enqueue_script(
            Plugin::getAssetsPrefix() . 'admin-script',
            Plugin::getAssetsUrl() . 'assets/js/admin.js',
            array('jquery'),
            Plugin::getVersion(),
            true
        );
    }
}