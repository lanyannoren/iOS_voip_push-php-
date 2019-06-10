<?php

function apns(){
    $deviceToken = 'cded007a bfc2c827 b5be30e7 9102241e 1bf2501c ddb62770 fec5ea29 7c17e9cd';
//ck.pem密码
    $pass = '';


//消息内容
    $message = 'A test message!';
//数字
    $badge = 4;
    $sound = 'default';
    $body = array();
    $body['aps'] = array('alert' => $message);
//把数组数据转换为json数据
    $payload = json_encode($body);
    echo strlen($payload),"\r\n";
    $ctx = stream_context_create([
        'ssl' => [
            'verify_peer'      => false,
            'verify_peer_name' => false
            // 'cafile'           => '/path/to/bundle/entrust_2048_ca.cer',
        ]
    ]);
// $pem = dirname(__FILE__) .'/'.'ck.pem';
    stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
    stream_context_set_option($ctx, 'ssl', 'passphrase', $pass);
    $fp = stream_socket_client('tls://gateway.sandbox.push.apple.com:2195',$err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
    if (!$fp) {
        print "Failed to connect $err $errstr\n";
        return;
    }
    else {
        print "Connection OK\n<br/>";
    }
// send message
    $msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
    print "Sending message :" . $payload . "\n";
    fwrite($fp, $msg);
    fclose($fp);
    /*
    35 Connection OK
    Sending message :{"aps":{"alert":"A test message!"}} �
    */
}


function voip(){
    $deviceToken = '93ad2db1 a80ee11a 08caa629 0b23684c f359d2b1 15bde1fd 108d7cba b2b08847';
//ck.pem密码
    $pass = '';


//消息内容
    $message = 'A test message!';
//数字
    $badge = 4;
    $sound = 'default';
    $body = array();
    $body['aps'] = array('alert' => $message);
//把数组数据转换为json数据
    $payload = json_encode($body);
    echo strlen($payload),"\r\n";
    $ctx = stream_context_create([
        'ssl' => [
            'verify_peer'      => false,
            'verify_peer_name' => false
            // 'cafile'           => '/path/to/bundle/entrust_2048_ca.cer',
        ]
    ]);
// $pem = dirname(__FILE__) .'/'.'ck.pem';
    stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
    stream_context_set_option($ctx, 'ssl', 'passphrase', $pass);
    $fp = stream_socket_client('tls://gateway.sandbox.push.apple.com:2195',$err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
    if (!$fp) {
        print "Failed to connect $err $errstr\n";
        return;
    }
    else {
        print "Connection OK\n<br/>";
    }
// send message
    $msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
    print "Sending message :" . $payload . "\n";
    fwrite($fp, $msg);
    fclose($fp);

}



voip();
