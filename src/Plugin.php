<?php

namespace G28\ThriveCartMemberKit;

class Plugin
{
    protected static ?Plugin $_instance = null;

    /**
     * @var string
     */
    private static string $url;

    /**
     * @var string
     */
    private static string $dir;

    /**
     * @var string
     */
    private static string $plugin_base;

    /**
     * @var string
     */
    private static string $slug;

    /**
     * @var string
     */
    private static string $text_domain;

    /**
     * @var string
     */
    private static string $assets_prefix;

    /**
     * @var string
     */
    private static string $assets_url;

    /**
     * @var string
     */
    private static string $template_dir;

    /**
     * @var string
     */
    private static string $log_dir;

    /**
     * @var string
     */
    private static string $version;

    private static string $integration_option_key;

    private static string $thrivecart_api_key;

    private static string $memberkit_api_key;

    private static string $memberkit_api_url;

    private function __construct($root, $version)
    {
        self::$url                          = plugin_dir_url($root);
        self::$dir                          = plugin_dir_path($root);
        self::$plugin_base                  = plugin_basename($root);
        self::$template_dir                 = self::$dir . 'templates/';
        self::$log_dir                      = self::$dir . 'logs/';
        self::$slug                         = trim(dirname(self::$plugin_base), '/');
        self::$assets_url                   = self::$url . 'assets/';
        self::$text_domain                  = self::$slug;
        self::$assets_prefix                = 'thrivecart-memberkit-';
        self::$version                      = $version;
        self::$integration_option_key       = "tcmk_integrations";
        self::$thrivecart_api_key           = "tcmk_thrivecart_api_key";
        self::$memberkit_api_key            = "tcmk_memberkit_api_key";
        self::$memberkit_api_url            = "tcmk_memberkit_api_url";
    }

    public static function getInstance($root, $version): ?Plugin
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self($root, $version);
        }
        return self::$_instance;
    }

    /**
     * @return string
     */
    public static function getUrl(): string
    {
        return self::$url;
    }

    /**
     * @return string
     */
    public static function getDir(): string
    {
        return self::$dir;
    }

    /**
     * @return string
     */
    public static function getPluginBase(): string
    {
        return self::$plugin_base;
    }

    /**
     * @return string
     */
    public static function getTemplateDir(): string
    {
        return self::$template_dir;
    }

    /**
     * @return string
     */
    public static function getLogDir(): string
    {
        if (!file_exists(self::$log_dir)) {
            mkdir(self::$log_dir);
        }
        return self::$log_dir;
    }

    /**
     * @return string
     */
    public static function getSlug(): string
    {
        return self::$slug;
    }

    /**
     * @return string
     */
    public static function getTextDomain(): string
    {
        return self::$text_domain;
    }

    /**
     * @return string
     */
    public static function getAssetsPrefix(): string
    {
        return self::$assets_prefix;
    }

    /**
     * @return string
     */
    public static function getAssetsUrl(): string
    {
        return self::$assets_url;
    }

    /**
     * @return string
     */
    public static function getVersion(): string
    {
        return self::$version;
    }

    /**
     * @return string
     */
    public static function getIntegrationOptionKey(): string
    {
        return self::$integration_option_key;
    }

    /**
     * @return string
     */
    public static function getThrivecartApiKey(): string
    {
        return self::$thrivecart_api_key;
    }

    /**
     * @return string
     */
    public static function getMemberkitApiKey(): string
    {
        return self::$memberkit_api_key;
    }

    /**
     * @return string
     */
    public static function getMemberkitApiUrl(): string
    {
        return self::$memberkit_api_url;
    }
}