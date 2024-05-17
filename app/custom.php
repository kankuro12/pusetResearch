<?php

define('t_books','books');

function vasset($file){
    return route('admin.file',['filename'=>urlencode($file)]);
}

