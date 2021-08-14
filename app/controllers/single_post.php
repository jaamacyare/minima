<?php

class Single_post extends Controller
{
    function index($link = '')
    {
        if ($link == "") {

            $data['page_title'] = "Image Not Found";
            $this->view("minima/not_found", $data);
        } else {

            $posts = $this->loadModel("posts");
            $result =  $posts->get_one($link);
            $data['post'] = $result;

            $data['page_title'] = "Single Post";
            $this->view("minima/single_post", $data);
        }
    }
}
