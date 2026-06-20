<?php
chdir(__DIR__);

$files = [
    'js/build/jquery/jquery.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js',
    'js/build/jquery-ui/jquery-ui.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js',
    'js/build/jquery-validation/jquery.validate.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js',
];

foreach ($files as $path => $url) {
    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $content = file_get_contents($url);
    if ($content !== false) {
        file_put_contents($path, $content);
        echo "Downloaded $path\n";
    } else {
        echo "Failed to download $path\n";
    }
}
echo "Done JS fixing.\n";
