<?php
namespace Ant;

class Pipeline
{
    private $ip;
    private $port;
    private $socket;
    public function execute($data = null)
    {
        $this->ip = $data['server'];
        $this->port = $data['port'];
        $this->socket = stream_socket_client("tcp://{$this->ip}:{$this->port}",$errno,$errstr,3);
        if(!$this->socket){

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