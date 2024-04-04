<?php

namespace G28\ThriveCartMemberKit;

if (!function_exists(__NAMESPACE__ . 'runPlugin')) {
    function runPlugin( $root ): void
    {
        Plugin::getInstance( $root );
		add_action('plugins_loaded', function (){
			new AdminController();
		});
        add_action( 'rest_api_init', function (){
			new Webhook();
		});
    }

}