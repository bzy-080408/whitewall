<?php
// 要扫描的主机地址
$host = '127.0.0.1';

// 要扫描的端口范围
$start_port = 1;
$end_port = 65535;

// 扫描端口
for ($port = $start_port; $port <= $end_port; $port++) {
    // 创建一个套接字
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    // 设置套接字超时
    socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));
    // 连接到主机
    if (@socket_connect($socket, $host, $port)) {
        // 如果连接成功，则说明端口是开放的
        echo "Port $port is open\n";
        // 关闭套接字
        socket_close($socket);
    }
}
?>