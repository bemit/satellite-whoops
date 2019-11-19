<?php

function enableNiceDebug(\Satellite\SystemLaunchEvent $exec) {
    $whoops = new \Whoops\Run;

    if($exec->cli) {
        $whoops->prependHandler(new \Whoops\Handler\PlainTextHandler());
    } else {
        $type = filter_input(INPUT_SERVER, 'CONTENT_TYPE', FILTER_SANITIZE_STRING);
        if(false !== strpos($type, 'application/json')) {
            $whoops->prependHandler(new \Whoops\Handler\JsonResponseHandler());
        } else {
            $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
        }
    }
    $whoops->register();

    return $exec;
}
