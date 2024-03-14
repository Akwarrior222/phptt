<?php

// Set up server variables
$host = '3.104.64.37';
$port = 4000;

// Create a TCP/IP socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
    exit;
}

// Bind the socket to the address and port
$result = socket_bind($socket, $host, $port);
if ($result === false) {
    echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
    exit;
}

// Start listening for connections
$result = socket_listen($socket, 3); // Maximum 3 pending connections
if ($result === false) {
    echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
    exit;
}

echo "Server listening on $host:$port\n";

// Accept incoming connections and handle them
while (true) {
    // Accept a new connection
    $clientSocket = socket_accept($socket);
    if ($clientSocket === false) {
        echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
        break;
    }

    // Send response to the client
    $response = "You are in AWS Cloud. This is TECHESSAY, Checking pipe";
    socket_write($clientSocket, $response, strlen($response));

    // Close the client socket
    socket_close($clientSocket);
}

// Close the server socket
socket_close($socket);
