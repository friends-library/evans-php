<?php

use Peridot\Console\Environment;
use Evenement\EventEmitterInterface;

return function(EventEmitterInterface $emitter) {
    $emitter->on('peridot.start', function (Environment $env) {
        $definition = $env->getDefinition();
        $definition->getArgument('path')->setDefault('src');
    });
};
