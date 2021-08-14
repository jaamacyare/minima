<?php

class About extends Controller
{
    function index($page = '')
    {
        $data['page_title'] = "About";
        $this->view("minima/about-us", $data);
    }
}
