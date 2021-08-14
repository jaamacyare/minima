<?php

class Contact extends Controller
{
    function index($page = '')
    {


        $data['page_title'] = "Contact Us";
        $this->view("minima/contact", $data);
    }
}
