<?php
/*
 * Plugin Name: Thrivecart and MemberKit Integration
 * Plugin URI: #
 * Description: Plugin to integrate Thrivecart and MemberKit, sending new users to MemberKit after purchase.
 * Version: 0.1.3
 * Author: G28 - Guilherme Pereira
 * Author URI: http://web.whatsapp.com/send?phone=5531990891617
 */

 if ( ! defined( 'ABSPATH' ) ) exit;

 require "vendor/autoload.php";
 use function G28\ThriveCartMemberKit\runPlugin;
 runPlugin(__FILE__, "0.1.3");