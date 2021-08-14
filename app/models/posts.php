<?php

class Posts
{
    function get_all()
    {
        $page_num = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page_num = $page_num < 1 ? 1 : $page_num;
        $limit = 2;
        $offset = ($page_num - 1) * $limit;

        $query = "SELECT * FROM images ORDER BY id desc LIMIT $limit offset $offset";
        $DB = new Database();
        $data =  $DB->read($query);
        if (is_array($data)) {
            return $data;
        }
        return false;
    }
    function get_one($link)
    {
        $query = "SELECT * FROM images WHERE url_address = :link LIMIT 1";
        $arr['link'] = $link;
        $DB = new Database();
        $data =  $DB->read($query, $arr);
        if (is_array($data)) {
            return $data[0];
        }
        return false;
    }
}
