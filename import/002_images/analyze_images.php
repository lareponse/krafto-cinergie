<?php

function analyze_images($dir, $csvfile) {
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != "." && $file != ".." && strpos($file, 'mcith') !== 0 && strpos($file, '.vignettes') !== 0) {
                $filepath = $dir . "/" . $file;
                if (is_dir($filepath)) {
                    analyze_images($filepath, $csvfile);
                } else {
                    // Check if file is an image
                    $mime = mime_content_type($filepath);
                    if (substr($mime, 0, 5) == 'image') {
                        // Analyze image dimensions, resolution and file size
                        list($width, $height) = getimagesize($filepath);
                        $filesize = filesize($filepath);
                        $extension = pathinfo($filepath, PATHINFO_EXTENSION);
                        $resolution = round($width / 72 * 25.4) . 'x' . round($height / 72 * 25.4) . ' dpi';

                        // Output the results to a CSV file
                        $data = array($filepath, $filesize, $width, $height, $resolution, $extension, $mime);
                        fputcsv($csvfile, $data);
                    }
                }
            }
        }
    }
}

// Get the directory to analyze from the command line argument
if ($argc < 2) {
    echo "Usage: php analyze_images.php <directory>\n";
    exit(1);
}
$dir = $argv[1];

// Open the CSV file for writing
$csvfile = fopen("output.csv", "w");
if (!$csvfile) {
    echo "Error: could not open output.csv for writing\n";
    exit(1);
}

// Write the header row to the CSV file
$header = array("Path", "File Size", "Width", "Height", "Resolution", "Extension", "MIME Type");
fputcsv($csvfile, $header);

// Analyze all images in the directory and write the results to the CSV file
analyze_images($dir, $csvfile);

// Close the CSV file
fclose($csvfile);

echo "Analysis complete! Results written to output.csv\n";

?>
