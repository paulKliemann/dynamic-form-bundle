<?php

namespace DynamicFormBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @package DynamicFormBundle\DependencyInjection
 */
class DynamicFormExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('dynamic_form.file_upload_dir', $config['file_upload_dir']);

        $locator = new FileLocator(__DIR__ . '/../Resources/config/');
        $loader  = new YamlFileLoader($container, $locator);

        $loader->load('services.yml');
    }
}