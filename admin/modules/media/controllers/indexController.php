<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    // load_model('index');
}

function indexAction() {
    load_view("index");
}

function listMediaAction() {
    load_view("list_media");
}