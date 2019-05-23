<?php


namespace Ant;


class Ant
{
    /**
     * project root path
     */
    const ROOT_PATH = __DIR__;

    /**
     * @var
     */
    public static $config;

    /**
     * @var
     */
    private $token;

    /**
     * @var Pipeline
     */
    private $pipeline;

    /**
     * Ant constructor.
     */
    public function __construct()
    {
        $config = file_get_contents(dirname(Ant::ROOT_PATH) . DIRECTORY_SEPARATOR . 'ini.json');
        self::$config = (array)json_decode($config, true);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function prepare()
    {
        $this->token = Helper::randomCode();
        $this->pipeline = new Pipeline(self::$config);
        Structure::$information['event'] = "register";
        Structure::$information['token'] = $this->token;
        Structure::$information['message'] = "start at " . date("Y-m-d H:i:s");
        $this->pipeline->write(Structure::$information);
        return $this->token;
    }

    /**
     * @param $token
     * @param $event
     * @param $message
     * @return Pipeline
     * @throws \Exception
     */
    public function send($token, $event, $message)
    {
        if(!$this->pipeline){
            $this->pipeline = new Pipeline(self::$config);
        }
        Structure::$information['event'] = $event;
        Structure::$information['token'] = $token;
        Structure::$information['message'] = $message;
        return $this->pipeline->write(Structure::$information);
    }

    /**
     * @param $token
     * @throws \Exception
     */
    public function close($token)
    {
        Structure::$information['event'] = "logout";
        Structure::$information['token'] = $token;
        Structure::$information['message'] = "tcp closed";
        $this->pipeline->write(Structure::$information);
        $this->pipeline = null;
    }
}