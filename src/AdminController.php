<?php

namespace G28\ThriveCartMemberKit;

class AdminController
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'), 99);
        add_action('wp_ajax_save_integration', array($this, 'save_integration'));
        add_action('wp_ajax_remove_integration', array($this, 'remove_integration'));
        add_action('wp_ajax_save_settings', array($this, 'save_settings'));
    }

    public function add_admin_menu(): void
    {
        add_menu_page(
            'ThriveCart MemberKit',
            'ThriveCart MemberKit',
            'manage_options',
            'thrivecart-memberkit',
            array($this, 'admin_page'),
            'dashicons-admin-links',
            6
        );
    }

    public function admin_page(): void
    {
        try {
            $thrivecart = new Thrivecart();
            $tc_products = $thrivecart->list_products();
        } catch (\Exception $e) {
            Logger::getInstance()->add("ERROR | Admin Page => " . $e->getMessage());
            $tc_products = [
                [
                    'id' => 0,
                    'name' => 'No se pueden cargar los produtos. recargar la pagina.'
                ]
            ];
        }
        try {
            $memberkit = new Memberkit();
            $classrooms = $memberkit->getClassroms();
        } catch (\Exception $e) {
            Logger::getInstance()->add("ERROR | Admin Page => " . $e->getMessage());
            $classrooms = [
                [
                    'id' => 0,
                    'name' => 'No se pueden cargar los grupos. recargar la pagina.'
                ]
            ];
        }

        $logs = Logger::getInstance()->getLogContent();
        $integrations = Options::getInstance()->getIntegrations();
        $settings = Options::getInstance()->getSettings();

        ob_start();
        include_once sprintf("%sadmin-page.php", Plugin::getTemplateDir());
        echo ob_get_clean();
    }

    public function enqueue_scripts(): void
    {
        wp_enqueue_style(
            Plugin::getAssetsPrefix() . 'admin-style',
            Plugin::getAssetsUrl() . 'css/admin.css',
        );
        wp_enqueue_script(
            Plugin::getAssetsPrefix() . 'admin-script',
            Plugin::getAssetsUrl() . 'js/admin.js',
            array('jquery', 'jquery-ui-tabs'),
            Plugin::getVersion(),
            true
        );
        wp_localize_script(Plugin::getAssetsPrefix() . 'admin-script', 'obj', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'tcmk_nonce' => wp_create_nonce('tcmk_nonce'),
            'action_save_integration' => 'save_integration',
            'action_remove_integration' => 'remove_integration',
            'action_save_settings' => 'save_settings'
        ]);
    }

    public function save_integration(): void
    {
        try {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $classroom_id = $_POST['classroom_id'];
            $classroom_name = $_POST['classroom_name'];

            $options = Options::getInstance();
            $options->addIntegration(
                [
                    'name' => $product_name,
                    'id' => $product_id,
                ],
                [
                    'name' => $classroom_name,
                    'id' => $classroom_id
                ]
            );
            wp_send_json_success();
        } catch (\Exception $e) {
            Logger::getInstance()->add("ERROR | Save Integration => " . $e->getMessage());
            wp_send_json_error($e->getMessage());
        }
        wp_die();
    }

    public function remove_integration(): void
    {
        try {
            $product_id = $_POST['product_id'];
            $classroom_id = $_POST['classroom_id'];

            $options = Options::getInstance();
            $integrations = $options->getIntegrations();
            $integrations = array_filter($integrations, function ($integration) use ($product_id, $classroom_id) {
                return $integration['product']['id'] !== $product_id || $integration['classroom']['id'] !== $classroom_id;
            });
            update_option(Plugin::getIntegrationOptionKey(), $integrations);
            wp_send_json_success();
        } catch (\Exception $e) {
            Logger::getInstance()->add("ERROR | Remove Integration => " . $e->getMessage());
            wp_send_json_error($e->getMessage());
        }
        wp_die();
    }

    public function save_settings(): void
    {
        try {

            $tck = $_POST['thrivecart_api_key'];
            $mkk = $_POST['memberkit_api_key'];
            $mku = $_POST['memberkit_api_url'];

            $options = Options::getInstance();
            $options->saveSettings($tck, $mkk, $mku);
            wp_send_json_success();
        } catch (\Exception $e) {
            Logger::getInstance()->add("ERROR | Save Settings => " . $e->getMessage());
            wp_send_json_error($e->getMessage());
        }
        wp_die();
    }
}