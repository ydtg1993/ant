## About ant
  
    ant is a message middleware. php send message then middleware dispatch this message to websocket client.

<table><thead><tr><th style="text-align:center;">Ant</th>
<th style="text-align:left;">PHP</th>
</tr></thead><tbody><tr><td style="text-align:left;">v1.0</td>
<td style="text-align:left;">&gt;=7.0</td>
</tr></tbody></table>

### 1. build
composer require stream/ant    

### 2. startup service

`windows`    start /B (YOUR_PATH)vendor/stream/ant/anthill.exe

`linux`    (YOUR_PATH)vendor/stream/junkman/anthill &

### code

    $ant = new Ant();
    $token = $ant->prepare();
create the Ant object to register a communication token then you could save this for client.
whenever you could take this token to send message to client.

    $ant->send($token,Structure::NOTICE_EVENT,"this is a message form php");
send message to the client that it has the same token.

    $ant->send("",Structure::BROADCAST_EVENT,"this is a message form php");
broadcast message 

    $ant->close($token);
close a client that it has this token.    

