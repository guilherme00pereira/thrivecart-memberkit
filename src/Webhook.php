<?php

namespace G28\ThriveCartMemberKit;

use WP_REST_Controller;
use WP_REST_Server;

class Webhook extends WP_REST_Controller
{

	protected $namespace;

	public function __construct()
	{
		$this->namespace     = 'tcmk/v1';
		$this->register_routes();
	}

	public function register_routes() {
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

	public function Ping( $request ) {
		echo "pong";
	}

	public function RegisterUser( $request ) {
		$params   		= $request->get_json_params();
		Logger::getInstance()->add( "Requisição recebida: " . json_encode( $params ) );
		$mkit = new Memberkit();
		$mkit->addUser( $params['full_name'], $params['email'], $params['classroom_ids'], $params['course_string'] );
	}

	
}