<?php

    $rules = "Options -Indexes\n\nIndexOptions FancyIndexing";

    $folders = array(
        'controllers',
        'css',
        'fonts',
        'js',
        'models',
        'php',
        'resources'
    );
    
    foreach ($folders as $key => $value):
        $path ='./'.$value.'/.htaccess';
        if(file_exists($path)):
            unlink($path);
            $file = fopen($path, 'w');
            fwrite($file, $rules);
            fclose($file);
        else:
            $file = fopen($path, 'w');
            fwrite($file, $rules);
            fclose($file);
        endif;
    endforeach;

?>