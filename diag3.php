<?php
chdir(__DIR__);

// Fix config.inc.php - turn off display_errors
$config = file_get_contents('config.inc.php');
$config = str_replace('display_errors = On', 'display_errors = Off', $config);
$config = str_replace('show_stacktrace = On', 'show_stacktrace = Off', $config);
file_put_contents('config.inc.php', $config);
echo "config.inc.php updated\n";

// Clear all caches
$dirs = [
    'cache/_db',
    'cache/t_compile',
];
foreach ($dirs as $dir) {
    if (is_dir($dir)) {
        $files = glob("$dir/*");
        foreach ($files as $f) {
            if (is_file($f)) unlink($f);
        }
        echo "Cleared: $dir\n";
    }
}

// Clear CSS cache in cache/ root
foreach (glob('cache/*.css') as $f) {
    unlink($f);
}
echo "Cleared cache CSS\n";

// Delete diagnostic files
@unlink('diag.php');
@unlink('diag2.php');
@unlink('diag3.php');
echo "Diagnostic files removed\n";

echo "All done!\n";
