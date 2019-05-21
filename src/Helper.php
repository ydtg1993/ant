<?php


namespace Ant;


class Helper
{
    /**
     * @return string
     */
    public static function randomCode()
    {
        return md5(uniqid(mt_rand()).microtime());
    }
}