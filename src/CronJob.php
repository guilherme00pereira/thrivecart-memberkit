<?php

namespace G28\ThriveCartMemberKit;

class CronJob
{
    public function __construct()
    {
        add_action('init', array($this, 'schedule_cron'));
        add_action('thrivecart_memberkit_cron', array($this, 'cron_job'));
    }

    public function schedule_cron(): void
    {
        if (!wp_next_scheduled('thrivecart_memberkit_cron')) {
            wp_schedule_event(time(), 'daily', 'thrivecart_memberkit_cron');
        }
    }

    public function cron_job(): void
    {
        $logDir = Plugin::getLogDir();
        $files = scandir($logDir);
        foreach ($files as $file) {
            if (is_file($logDir . $file) && time() - filemtime($logDir . $file) >= 7 * 24 * 60 * 60) {
                unlink($logDir . $file);
            }
        }
    }
}