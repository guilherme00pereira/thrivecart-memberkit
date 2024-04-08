<?php

namespace G28\ThriveCartMemberKit;

use WP_REST_Controller;
use WP_REST_Response;
use WP_REST_Server;

class Webhook extends WP_REST_Controller
{

	protected $namespace;

	public function __construct()
	{
		$this->namespace     = 'tcmk/v1';
		$this->register_routes();
	}

	public function register_routes(): void
    {
		register_rest_route( $this->namespace, '/ping',
			array(
				'methods'  => WP_REST_Server::READABLE,
				'callback' => array( $this, 'Ping' ),
			)
		);
		register_rest_route( $this->namespace, '/register-user-mkit', array(
			'methods'       => WP_REST_Server::ALLMETHODS,
			'callback'      => array( $this, 'RegisterUser' )
		));
	}

	public function Ping( $request ): void
    {
		echo "pong";
	}

	public function RegisterUser( $request ): WP_REST_Response
    {
        try {
            $data = $request->get_body_params();
            $secret = $data['thrivecart_secret'];
            if(strcmp("YNYP9RNGJ80J", $secret) !== 0) {
                Logger::getInstance()->add("WEBHOOK Invalid secret: " . $secret);
                return new WP_REST_Response('Invalid secret', 401);
            } else {
                $event = $data['event'];
                Logger::getInstance()->add("WEBHOOK Receiving event: " . $event);
                if (strcmp($event, 'order.success')) {
                    $product_id = $data['base_product'];
                    Logger::getInstance()->add("WEBHOOK Receiving product: " . $product_id);
                    $customer = $data['customer'];
                    Logger::getInstance()->add("WEBHOOK Receiving customer: " . $customer);
                    $mkit = new Memberkit();
                    $mkit->addUser($product_id, $customer);
                }
                return new WP_REST_Response('User registered', 201);
            }
        } catch (\Exception $e) {
            return new WP_REST_Response($e->getMessage(), 500);
        }
    }

	
}