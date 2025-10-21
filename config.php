<?php

function getConfig(string $name, string $section = null): ?string
{
    $envs = ['dev', 'prod'];
    $configs = [];
    $processSection = null !== $section;
    foreach($envs as $env) {
        $configFilePath = realpath(__DIR__ . "/config/$env.ini");
        $config = [];
        if (file_exists($configFilePath)) {
            $config = parse_ini_file($configFilePath, $processSection);
            if ($processSection) {
                $config = $config[$section] ?? [];
            }
        }
        $configs[] = $config;
    }

    $config = array_merge(...$configs);

    return $config[$name] ?? null;
}