<?php

namespace Satellite\Whoops;

class NiceDebug {
    public static function enable(
        $cli = false,
        ?string $editor = null,
    ): void {
        $whoops = new \Whoops\Run();

        if($cli) {
            $handler = new \Whoops\Handler\PlainTextHandler();
        } else {
            $type = filter_input(INPUT_SERVER, 'CONTENT_TYPE');
            if(str_contains($type, 'application/json')) {
                $handler = new \Whoops\Handler\JsonResponseHandler();
            } else {
                $handler = new \Whoops\Handler\PrettyPageHandler();
                if(is_string($editor)) {
                    $handler->setEditor($editor);
                }
            }
        }
        $whoops->prependHandler($handler);
        $whoops->register();
    }
}
