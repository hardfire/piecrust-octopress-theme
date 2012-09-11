<?php

require_once 'src/SassProcessor.php';

use PieCrust\PieCrustPlugin;


class SassPlugin extends PieCrustPlugin
{
    public function getName()
    {
        return "Sass";
    }

    public function getProcessors()
    {
        return array(
            new PieCrust\Sass\SassProcessor()
        );
    }
}

