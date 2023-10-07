<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    // load_model('index');
}

function indexAction() {
    load_view("index");
}

function addSliderAction() {
    load_view("add_slider");
}

function listSliderAction() {
    load_view("list_slider");
}