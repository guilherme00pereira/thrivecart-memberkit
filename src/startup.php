<?php

namespace G28\ThriveCartMemberKit;

if (!function_exists(__NAMESPACE__ . 'runPlugin')) {
    function runPlugin( $root, $version ): void
    {
        Plugin::getInstance( $root, $version );
		add_action('plugins_loaded', function (){
			new AdminController();
            new CronJob();
		});
        add_action( 'rest_api_init', function (){
			new Webhook();
		});
    }

}