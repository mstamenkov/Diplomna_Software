<?php
$serv=stream_socket_server("tcp://78.130.176.19:5000",$errno,$errstr) or die("create server failed");

for($i=0; $i < 2; $i ++) {
    if (pcntl_fork() == 0 ) {
        while(1) {
            $conn = stream_socket_accept($serv);
            if ($conn == false) continue;
            else{
                while(1){
                        $request = fread($conn,100);          //do some thing
            //$response = "hello world";
                        fwrite(STDOUT, $request);
                        if($conn == false) break;
                }
            }
            fclose($conn);
        } exit(0);
    }
}