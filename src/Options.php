<?php

namespace G28\ThriveCartMemberKit;

class Options
{
    private static ?Options $_instance = null;

    public function __construct()
    {
        if(is_bool(get_option(Plugin::getIntegrationOptionKey()))) {
            add_option(Plugin::getIntegrationOptionKey(), []);
        }
        if(is_bool(get_option(Plugin::getThrivecartApiKey()))) {
            add_option(Plugin::getThrivecartApiKey(), "");
        }
        if(is_bool(get_option(Plugin::getMemberkitApiKey()))) {
            add_option(Plugin::getMemberkitApiKey(), "");
        }
        if(is_bool(get_option(Plugin::getMemberkitApiUrl()))) {
            add_option(Plugin::getMemberkitApiUrl(), "");
        }
    }

    public static function getInstance(): ?Options {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getIntegrations(): array
    {
        $integrations = get_option(Plugin::getIntegrationOptionKey());
        if(is_bool($integrations)) {
            return [];
        }
        return $integrations;
    }

    public function addIntegration( array $product, array $classroom ): void
    {
        $integrations = $this->getIntegrations();
        $integrations[] = [
            'product' => $product,
            'classroom' => $classroom
        ];
        update_option(Plugin::getIntegrationOptionKey(), $integrations);
    }
    
    public function getSettings()
    {
        $settings = [];
        $settings[Plugin::getThrivecartApiKey()]        = get_option(Plugin::getThrivecartApiKey());
        $settings[Plugin::getMemberkitApiKey()]         = get_option(Plugin::getMemberkitApiKey());
        $settings[Plugin::getMemberkitApiUrl()]         = get_option(Plugin::getMemberkitApiUrl());
        return $settings;
    }

    public function saveSettings( $thrivecart_key, $memberkit_key, $memberkit_url ): void
    {
        update_option(Plugin::getThrivecartApiKey(), $thrivecart_key);
        update_option(Plugin::getMemberkitApiKey(), $memberkit_key);
        update_option(Plugin::getMemberkitApiUrl(), $memberkit_url);
    }

    public function getThrivecartApiKey(): string
    {
        return get_option(Plugin::getThrivecartApiKey());
    }

    public function getMemberkitApiKey(): string
    {
        return get_option(Plugin::getMemberkitApiKey());
    }   

    public function getMemberkitApiUrl(): string
    {
        return get_option(Plugin::getMemberkitApiUrl());
    }
}