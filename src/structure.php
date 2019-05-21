<?php


namespace Ant;


class structure
{
    const NOTICE_EVENT = "notice";
    const BROADCAST_EVENT = "broadcast";
    const REGISTER_EVENT = "register";
    const LOGOUT_EVENT = "logout";

    public static $information = [
        "event" => "",
        "token" => "",
        "message" => ""
    ];
}