## About ant
  
    ant is a message middleware. php uses tcp to send message then middleware 
    dispatches this message to websocket client.  

![example](https://github.com/ydtg1993/ant/blob/master/example/client/source/express.gif)

### 1. build

    composer require stream/ant    

### 2. startup service

windows   

    start /B (YOUR_PATH)vendor/stream/ant/anthill.exe

linux    

    (YOUR_PATH)vendor/stream/ant/anthill &
    
    
    tips： 
      the server should open firewall to enable port of 9303 9333, 
      for tcp and websocket
       
    command:
      iptables -A INPUT -p tcp --dport 9303 -j ACCEPT
      iptables -A OUTPUT -p tcp --sport 9303 -j ACCEPT
      iptables -A INPUT -p tcp --dport 9333 -j ACCEPT
      iptables -A OUTPUT -p tcp --sport 9333 -j ACCEPT
      service iptables save

### 3. code in php
create the Ant object to register a communication token then you could save this for client.
whenever you could take this token to send message to client
  
    $ant = new Ant();
    $token = $ant->prepare();


send message to the client whitch has the same token
    
    $ant->send($token,Structure::NOTICE_EVENT,"this is a message form php");


broadcast message 
    
    $ant->send("",Structure::BROADCAST_EVENT,"this is a message form php");


close a client that it has this token
    
    $ant->close($token);
 
### 4. websocket client example

    open this (YOUR_PATH)vendor/stream/ant/example/client/index.html
 

