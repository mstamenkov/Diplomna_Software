<?php
$serv=stream_socket_server("tcp://78.130.176.59:5000",$errno,$errstr) or die("create server failed");
require_once "./config.php";
$id;
for($i=0; $i < 2; $i ++) {
    if (pcntl_fork() == 0 ) {
        while(1) {
            $conn = stream_socket_accept($serv);
            if ($conn == false) continue;
            else{
                while(1){
                        $request = fread($conn,100);
//                      fwrite(STDOUT, $request);
                        $gpsId = strpos($request,'GNGGA');
                        if($gpsId != false){
                            $longIndex = $gpsId+17;
                            $langIndex = $gpsId+29;
                            $long = substr($request,$longIndex,9);
                            $lang = substr($request,$langIndex,10);
                            $longDecimal = substr($request,0,2) + substr($request,2);
                            fwrite(STDOUT, $long);
                            fwrite(STDOUT, " ");
                            fwrite(STDOUT, $lang);
                            fwrite(STDOUT, "\n");
                            /*if($id[0] == 1) {
                                $stmt = $con->prepare("INSERT INTO moduleData(eventTime, moduleId, latitude, longitude) VALUES(NOW(),$id,)");
                                $stmt->bind_param('s', $username);
                                $stmt->execute();
                            }*/
                            //echo $long;
                            //echo "<br>";
                            //echo $lang;
                        }else if(strlen($request) == 7){
                            $id = substr($request,0,4);
                            $shock = substr($request,5,1);
                            $rfid = substr($request,6,1);
                            fwrite(STDOUT, $shock);
                            fwrite(STDOUT, $rfid);
                        }else if(strlen($request) == 6){
                            $id = substr($request,0,4);
                            $imu = substr($request,5,1);
                            fwrite(STDOUT, $imu);
                        }
                        if($conn == false) break;
                }
            }
            fclose($conn);
        } exit(0);
    }
}
