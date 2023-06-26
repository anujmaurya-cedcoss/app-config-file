<?php

date_default_timezone_set("Asia/Calcutta");
define(
    "myApp",
    "[
        'name'=>'Config File App',
        'version'=>'1.1.1',
        'time'=>" . date('h-i-sa') . ",
        'timezone'=>'Asia/Calcutta',
        'language'=>'English'
    ]"
);
return myApp;
