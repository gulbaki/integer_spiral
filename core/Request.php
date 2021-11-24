<?php


namespace core;

use core\exceptions\RequestException;

class Request
{
    private const PATH_GET_KEY = 'php_hru';
    public const METHOD_POST = 'POST';
    public const METHOD_GET = 'GET';

    protected $get = [];
    protected $post = [];
    protected $cookie = [];
    protected $session = [];
    protected $files = [];
    protected $server = [];

    private $path = '';
    private $pathParts = [];

    /**
     * Request constructor.
     * @throws RequestException
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * @throws RequestException
     */
    protected function init()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->cookie = $_COOKIE;
      //  $this->session = $_SESSION;
        $this->files = $_FILES;
        $this->server = $_SERVER;

        //$this->processPath();
    }

    /**
     * @throws RequestException
     */
    private function processPath()
    {
        $path = $_GET[self::PATH_GET_KEY] ?? null;
        if (is_null($path)) {
            throw new RequestException(sprintf(
                    "Mapping is impossible. '%s' is not present in %s array",
                    self::PATH_GET_KEY,
                    '$_GET')
            );
        }
        $path = rtrim($path, '/');
        $this->setPath($path);

        unset($_GET[self::PATH_GET_KEY]);
    }

    /**
     * @param string $arrayName
     * @param $key
     * @return mixed
     * @throws RequestException
     */
    protected function getParam(string $arrayName, $key = null)
    {
        $arr = &$this->$arrayName ?? null;

        if ($arr === null) {
            throw new RequestException('Invalid array name');
        }

        if ($key === null) {
            return $arr;
        }

        
        return $arr[$key] ?? null;
    }

    /**
     * @param string $arrayName
     * @param $key
     * @param $val
     * @throws RequestException
     */
    public function setParam(string $arrayName, $key, $val)
    {
        $arr = &$this->$arrayName ?? null;

        if ($arr === null) {
            throw new RequestException('Invalid array name');
        }

        $arr[$key] = $val;
    }

    /**
     * @param $key
     * @return mixed
     * @throws RequestException
     */
    public function get($key = null)
    {
        return $this->getParam(__FUNCTION__, $key);
    }

    /**
     * @param $key
     * @param $val
     * @throws RequestException
     */
    public function setGet($key, $val) : void
    {
        $this->setParam('get', $key, $val);
    }

    /**
     * @param $key
     * @return mixed
     * @throws RequestException
     */
    public function post($key = null)
    {
        return $this->getParam(__FUNCTION__, $key);
    }

    /**
     * @param $key
     * @param $val
     * @throws RequestException
     */
    public function setPost($key, $val) : void
    {
        $this->setParam('post', $key, $val);
    }

    /**
     * @param $key
     * @return mixed
     * @throws RequestException
     */
    public function cookie($key = null)
    {
        return $this->getParam(__FUNCTION__, $key);
    }

    /**
     * @param $key
     * @return mixed
     * @throws RequestException
     */
    public function session($key = null)
    {
        return $this->getParam(__FUNCTION__, $key);
    }

    /**
     * @param $key
     * @return mixed
     * @throws RequestException
     */
    public function files($key = null)
    {
        return $this->getParam(__FUNCTION__, $key);
    }

    /**
     * @param $key
     * @return mixed
     * @throws RequestException
     */
    public function server($key = null)
    {
        return $this->getParam(__FUNCTION__, $key);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
        $this->pathParts = array_filter(explode('/', $path));
    }

    public function getPathParts(): array
    {
        return $this->pathParts;
    }

    public function isPost(): bool
    {
        return $this->server('REQUEST_METHOD') === self::METHOD_POST;
    }

    public function isGet() : bool
    {
        return $this->server('REQUEST_METHOD') === self::METHOD_GET;
    }
    //   abstract protected function init();
}