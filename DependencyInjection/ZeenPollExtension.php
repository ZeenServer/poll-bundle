<?php



namespace Zeen\PollBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;

//use Symfony\Component\DependencyInjection\Definition;
use Sonata\EasyExtendsBundle\Mapper\DoctrineCollector;

class ZeenPollExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);


        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        if (array_key_exists('SonataAdminBundle', $container->getParameter('kernel.bundles'))) {
            $loader->load('admin.xml');
        }

        $loader->load('services.xml');

    }

}
