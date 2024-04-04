<?php
/*
 * Plugin Name: Thrivecart and MemberKit Integration
 * Plugin URI: #
 * Description: Plugin to integrate Thrivecart and MemberKit, sending new users to MemberKit after purchase.
 * Version: 0.1.0
 * Author: G28 - Guilherme Pereira
 * Author URI: http://www.g28.com.br
 *
 */

 if ( ! defined( 'ABSPATH' ) ) exit;

 require "vendor/autoload.php";
 use function G28\ThriveCartMemberKit\runPlugin;
 runPlugin(__FILE__);