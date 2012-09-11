<?php

namespace PieCrust\Sass;

use PieCrust\IPieCrust;
use PieCrust\PieCrustException;
use PieCrust\Baker\Processors\SimpleFileProcessor;


class SassProcessor extends SimpleFileProcessor
{
    protected $binDir;
    protected $sassOptions;

    public function __construct()
    {
        parent::__construct('sass', array('scss', 'sass'), 'css');
    }
    
    public function initialize(IPieCrust $pieCrust)
    {
        parent::initialize($pieCrust);

        $this->binDir = $pieCrust->getConfig()->getValue('sass/bin_dir');
        if ($this->binDir != null)
            $this->binDir = rtrim($this->binDir, '/\\') . DIRECTORY_SEPARATOR;

        $style = $pieCrust->getConfig()->getValue('sass/style');
        if (!$style)
            $style = 'nested';

        $loadPaths = $pieCrust->getConfig()->getValue('sass/load_paths');
        if (!$loadPaths)
            $loadPaths = array();
        if (!is_array($loadPaths))
            $loadPaths = array($loadPaths);

        $this->sassOptions = '--style ' . $style;
        if ($pieCrust->isCachingEnabled())
            $this->sassOptions .= ' --cache-location "' . $pieCrust->getCacheDir() . '"';
        else
            $this->sassOptions .= ' --no-cache';
        foreach ($loadPaths as $p)
        {
            $this->sassOptions .= ' -I "' . $p . '"';
        }

        $miscOptions = $pieCrust->getConfig()->getValue('sass/misc_options');
        if ($miscOptions)
            $this->sassOptions .= ' ' . $miscOptions . ' ';
    }

    public function isDelegatingDependencyCheck()
    {
        return false;
    }

    public function getOutputFilenames($filename)
    {
        return pathinfo($filename, PATHINFO_FILENAME) . '.css';
    }

    protected function doProcess($inputPath, $outputPath)
    {
        $exePath = pathinfo($inputPath, PATHINFO_EXTENSION);
        if ($this->binDir != null)
            $exePath = $this->binDir . $exePath;

        shell_exec("{$exePath} {$this->sassOptions} --update \"{$inputPath}\":\"{$outputPath}\"");
    }
}
