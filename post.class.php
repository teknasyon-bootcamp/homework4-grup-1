<?php


require_once 'db.class.php';


class Post extends DB
{
    public int $id;
    public string $title = '';
    public string $content = '';

    public function __construct()
    {
    }
}
