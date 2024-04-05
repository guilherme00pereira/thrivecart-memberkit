<?php

namespace G28\ThriveCartMemberKit;

class Logger
{
    private static ?Logger $_instance = null;
    private string $logFile;

    public function __construct()
    {
        $this->logFile = "log_" . date("Ymd") . ".txt";
        if(!file_exists(Plugin::getLogDir() . $this->logFile)) {
            file_put_contents(Plugin::getLogDir() . $this->logFile, "");
        }
    }

    public static function getInstance(): ?Logger {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function add( string $message ): void
    {
        date_default_timezone_set('America/Sao_Paulo');
        $timestamp    = date('d/m/Y h:i:s A');
        $actualOutput = file_get_contents( Plugin::getLogDir() . $this->logFile );
        $output = "[ $timestamp ] $message" . PHP_EOL . $actualOutput;
        file_put_contents( Plugin::getLogDir() . $this->logFile, $output);
    }

    public function clear(): void
    {
        file_put_contents( Plugin::getLogDir() . $this->logFile, "");
    }

    public function getLogContent(): string
    {
        $filepath = Plugin::getLogDir() . $this->logFile;
        return nl2br(file_get_contents( $filepath ));
    }
}