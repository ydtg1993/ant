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

    public function __construct()
    {
        $config = file_get_contents(dirname(Ant::ROOT_PATH) . DIRECTORY_SEPARATOR . 'ini.json');
        self::$config = (array)json_decode($config, true);
    }

    public function prepare()
    {
        $token = Helper::randomCode();
        return $token;
    }

    private function config()
    {
        $config = file_get_contents(dirname(Ant::ROOT_PATH) . DIRECTORY_SEPARATOR . 'ini.json');
        self::$config = (array)json_decode($config, true);
    }
}