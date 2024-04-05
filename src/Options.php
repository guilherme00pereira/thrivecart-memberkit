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
}