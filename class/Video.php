<?php

class Video
{
    private $videoTable= 'videos';
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }
}