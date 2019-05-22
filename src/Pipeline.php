<?php
namespace Ant;

class Pipeline
{
    private $pattern;
    private $port;
    private $socket;

    public function __construct($config)
    {
        $this->pattern = $config['tcp']['pattern'];
        $this->port = $config['tcp']['port'];
        $this->socket = stream_socket_client("tcp://{$this->pattern}:{$this->port}",$errno,$errstr,3);
        if(!$this->socket){
            return null;
        }
        stream_set_blocking($this->socket,true);
    }
    /**
     * @param $data
     * @return $this
     * @throws \Exception
     */
    public function write($data)
    {
        if ($this->socket) {
            return (bool)fwrite($this->socket, json_encode($data,JSON_FORCE_OBJECT));
        }
        return false;
    }
    public function close()
    {
        stream_socket_shutdown($this->socket,STREAM_SOCK_DGRAM);
    }
    public function __destruct()
    {
        stream_socket_shutdown($this->socket,STREAM_SOCK_DGRAM);
    }
}