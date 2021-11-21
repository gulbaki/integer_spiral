<?php

namespace core;

class Route
{
    private $request_uri;
    private $patterns = [];
 
    function __construct()
    {
        $this->request_uri = $this->parse_url();
        $this->patterns =  [
            '{string}' => '([0-9a-zA-Z-\s]+)',
            '{int}' => '([0-9]+)'
        ];
    }
     /**
     * @return mixed
     */
    public function parse_url(): mixed
    {
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = $dirname != '/' ? $dirname : null;
        $basename = basename($_SERVER['SCRIPT_NAME']);
        $request_uri = str_replace([$dirname, $basename], '', $_SERVER['REQUEST_URI']);
        if (strstr($request_uri, '?')) $request_uri = substr($request_uri, 0, strpos($request_uri, '?'));
        return $request_uri;
    }
  
    /**
     * @param $url
     * @param $callback
     * @param $method
     * @return mixed
     */
    public function run(string $url, array $callback = [], string $method = 'get'): void
    {
        $method = explode('|', strtoupper($method));

        if (in_array($_SERVER['REQUEST_METHOD'], $method)) {
            $url = str_replace(array_keys($this->patterns), array_values($this->patterns), $url);

            if (preg_match('@^' . $url . '$@', $this->request_uri, $parameters)) {


                unset($parameters[0]);

                if (!is_array($callback)) {
                    call_user_func_array($callback, $parameters);
                    die();
                } else {
                    @call_user_func_array([new $callback[0], $callback[1]], $parameters);
                    die();
                }
            }
        }
    }
}