<?php

namespace Magium\Util\Configuration;

class StandardConfigurationProvider implements ConfigurationProviderInterface
{
    protected $configurationDir;

    protected $classConfigurationReader;

    protected $configurationReader;

    protected $environmentConfigurationReader;

    public function __construct(
        ConfigurationReader $configurationReader,
        ClassConfigurationReader $classConfigurationReader,
        EnvironmentConfigurationReader $environmentConfigurationReader,
        $configurationDir = null)
    {
        $this->configurationReader = $configurationReader;
        $this->classConfigurationReader = $classConfigurationReader;
        $this->environmentConfigurationReader = $environmentConfigurationReader;
        $this->configurationDir = $configurationDir;
    }

    public function configureObject(ConfigurableObjectInterface $obj)
    {
        $this->classConfigurationReader->setConfigurationDir($this->configurationDir);
        $this->classConfigurationReader->configure($obj);

        $this->configurationReader->configure($obj);

        $this->environmentConfigurationReader->configure($obj);
    }

}