<?php

namespace G28\ThriveCartMemberKit;

use Exception;

class Memberkit
{
    private string $apiUrl;
    private string $apiKey;

    /**
     * @throws Exception
     */
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
            Logger::getInstance()->add( "ERROR: " .$e->getCode() . " | Get Memberkit Classrooms => " . $e->getMessage() );
        }
        return $classrooms;
    }
	public function addUser( $product_id, $customer ): void
    {
        $integrations = Options::getInstance()->getIntegrations();
        $course_string = "";
        $ids = [];
        foreach ( $integrations as $integration ) {
            if( $integration['product']['id'] == $product_id ) {
                $ids[] = $integration['classroom']['id'];
                $course_string .= $integration['classroom']['name'] . ', ';
            }
        }

        Logger::getInstance()->add("MEMBERKIT IDS: " . json_encode($ids));
        if( empty( $ids ) ) {
            Logger::getInstance()->add("MEMBERKIT: No classrooms found for product " . $product_id);
        } else {
            Logger::getInstance()->add("MEMBERKIT: Enrolling user " . $customer['name'] . " on classrooms: " . $course_string);

            $course_string = rtrim($course_string, ', ');

            $params = [
                'body' => [
                    'full_name' => $customer['name'],
                    'email' => $customer['email'],
                    'status' => 'active',
                    'blocked' => false,
                    'classroom_ids' => $ids,
                    'api_key' => $this->apiKey
                ],
            ];
            $resp = wp_remote_post($this->apiUrl . 'users', $params);
            if (is_wp_error($resp)) {
                Logger::getInstance()->add("ERROR: " . $resp->get_error_code() . " | Add User Memberkit => " . $resp->get_error_message());
            } else {
                $userData = json_decode(wp_remote_retrieve_body($resp));;
                Logger::getInstance()->add("User " . $userData->full_name .
                    " has been succesfully enrolled on classrooms: " . $course_string);
            }
        }
    }


}