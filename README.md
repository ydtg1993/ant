## About ant
  
    ant is a message middleware. php sends message by tcp then middleware 
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
      firewall-cmd --zone=public --add-port=9303/tcp --permanent
      firewall-cmd --zone=public --add-port=9333/tcp --permanent
      firewall-cmd --reload

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
 

