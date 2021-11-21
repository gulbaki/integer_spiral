<?php


namespace controller;


class NotFound extends Base
{
    public const NOT_FOUND_MSG = 'Page not found! Please, try to start from Home Page.';

    public function indexAction(string $message = self::NOT_FOUND_MSG) {
        header("HTTP/1.1 404 Not Found");

        $this->content = self::getTemplate('v_not_found.php', [
            'message' => $message ?: self::NOT_FOUND_MSG
        ]);

    }
}