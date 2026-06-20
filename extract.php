<?php
$zipFile = __DIR__ . '/site_clean.zip';
$extractTo = __DIR__;

if (!file_exists($zipFile)) {
    die("Error: site_clean.zip not found at $zipFile\n");
}

// Set execution time limit to 10 minutes just in case
ini_set('max_execution_time', 600);
set_time_limit(600);

$zip = new ZipArchive;
if ($zip->open($zipFile) === TRUE) {
    echo "Extracting " . $zip->numFiles . " files using stream...\n";
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $filename = $zip->getNameIndex($i);
        // Normalize backslashes to forward slashes for Linux
        $normalizedName = str_replace('\\', '/', $filename);
        
        $targetPath = $extractTo . '/' . $normalizedName;
        
        // Check if it's a directory
        if (substr($normalizedName, -1) === '/') {
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }
            // Ensure the directory has execute/write permissions during extraction
            chmod($targetPath, 0755);
            continue;
        }
        
        // Ensure parent directory exists
        $parentDir = dirname($targetPath);
        if (!is_dir($parentDir)) {
            mkdir($parentDir, 0755, true);
        }
        // Ensure parent dir permissions are correct
        chmod($parentDir, 0755);
        
        // Extract file using streams
        $fpOut = @fopen($targetPath, 'wb');
        $fpIn = @$zip->getStream($filename);
        if ($fpOut && $fpIn) {
            stream_copy_to_stream($fpIn, $fpOut);
        }
        if ($fpOut) fclose($fpOut);
        if ($fpIn) fclose($fpIn);
        
        if (file_exists($targetPath)) {
            chmod($targetPath, 0644);
        }
    }
    $zip->close();
    echo "Extraction completed successfully!\n";
} else {
    echo "Failed to open zip file\n";
}
