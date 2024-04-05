<?php

namespace G28\ThriveCartMemberKit;

use Exception;

class Memberkit
{
	//const API_URL = "https://memberkit.com.br/api/v1/";
	//const MEMBERKIT_API_KEY = "W5oGXK99YMMiHWJRfeW5WAkp";

    private string $apiUrl;
    private string $apiKey;

	public function __construct()
	{
        $url = Options::getInstance()->getSettings()[Plugin::getMemberkitApiUrl()];
        $key = Options::getInstance()->getSettings()[Plugin::getMemberkitApiKey()];

        if( empty( $url ) || empty( $key ) ) {
            throw new Exception( "Memberkit API Key or URL not set" );
        } else {
            $this->apiUrl = $url;
            $this->apiKey = $key;
        }
	}

    public function getClassroms(): array
    {
        

        $classrooms = [];
        try {
            $resp = wp_remote_get( $this->apiUrl . 'classrooms', [
                'body' => [
                    'api_key' => $this->apiKey
                ]
            ]);

            if( is_wp_error( $resp ) ) {
                Logger::getInstance()->add( "ERROR: " .$resp->get_error_code() . " | Get Memberkit Classrooms => " . $resp->get_error_message() );
            } else {
                $reponse = wp_remote_retrieve_body( $resp );
                foreach ( json_decode( $reponse ) as $classroom ) {
                    $classrooms[] = [
                        'id'   => $classroom->id,
                        'name' => $classroom->name
                    ];
                }
            }
        } catch ( Exception $e ) {
            Logger::getInstance()->add( "ERROR: " .$e->get_error_code() . " | Get Memberkit Classrooms => " . $e->get_error_code() );
        }
        return $classrooms;
    }
	public function addUser( $name, $mail, $ids, $course_string ): void
    {
		$params = [
			'body' => [
				'full_name'     => $name,
				'email'         => $mail,
				'status'        => 'active',
				'blocked'       => false,
				'classroom_ids' => $ids,
				'api_key'       => self::MEMBERKIT_API_KEY
			],
		];
		$resp = wp_remote_post( self::API_URL . 'users', $params );
		if( is_wp_error( $resp ) ) {
			Logger::getInstance()->add( "ERROR: " .$resp->get_error_code() . " | Add User Memberkit => " . $resp->get_error_message() );
		} else {
			$userData = json_decode( wp_remote_retrieve_body( $resp ) );;
			Logger::getInstance()->add(  "User " . $userData->full_name .
			                             " has been succesfully enrolled on classrooms: " . $course_string);
		}
	}

}