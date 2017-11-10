<?php

// config
$media_path  = __dir__ . "/media"; // path to PDFs to display
$thumb_path  = __dir__ . "/thumb"; // path for storing thumbnail images
$thumb_width = 250;                // width of thumbnails on screen

// read the media files
$files       = scandir($media_path);

// trim '.' and '..'
array_shift($files);
array_shift($files);

// generates a thumbnail image
$thumb = function($file) use ($media_path, $thumb_path, $thumb_width) {

    // calculate file paths
    $source = "$media_path/$file";
    $dest   = "$thumb_path/" . basename($file, ".pdf") . '.jpg';

    // exit if the thumb already exists
    if (file_exists($dest)) {
        return;
    }

    // otherwise, generate the it
    $im = new Imagick($source."[0]"); // [0]: the first page
    $im->setimageformat("jpeg");
    $im->thumbnailimage($thumb_width, 0);
    $im->writeimage($dest);
    $im->clear();
    $im->destroy();
};

// generates link markup
$link = function($file) use ($thumb) {
    // generate a PDF thumbnail
    $thumb($file);

    // generate a PDF link
    $image = '/thumb/' . basename($file, '.pdf') . '.jpg';
    return "<a href='/media/$file' title='$file' alt='$file'><img src='$image'></a>";
};

?><html>
<head>
    <title>PDF Viewer</title>
    <style>
        /* Center the images on screen. (Kind of dirty, but it works.) */
        body {
            text-align: center;
        }

        img {
            margin: 20px;
            border-radius: 10px;
        }

        img:hover {
            transform: scale(1.1);
            transition: transform .25s ease;
        }
    </style>
</head>
<body>

<?php

// display a notice if no files are available
if (empty($files)) {
    echo "<p>No files to display.</p>";
}


// otherwise, display the index
else {
    foreach($files as $file) {
        echo $link($file);
    }
}

?>

</body>
</html>
