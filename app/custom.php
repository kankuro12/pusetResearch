<?php

function vasset($file){
    return route('admin.file',['filename'=>urlencode($file)]);
}

