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

    public function prepare(&$token = '')
    {
        if (!$token) {
            $token = Helper::randomCode();
        }
        $this->pipeline = new Pipeline(self::$config);
        Structure::$information['event'] = Structure::REGISTER_EVENT;
        Structure::$information['token'] = $token;
        Structure::$information['message'] = "start at " . date("Y-m-d H:i:s");
        $this->pipeline->write(Structure::$information);
        return $this->token;
    }

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


}