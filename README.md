php-pdf-viewer
==============
A quick-and-dirty PDF viewer implemented in PHP. Generates a visual index of
PDF thumbnails that link to their corresponding source files.

Don't use this "in production" - it was implemented hastily and for personal
use. No attention was paid to logging, error-handing, security, etc.

Usage
-----
1. Upload this file to a PHP-enabled webserver (requires Imagick as a dependency)
2. Create `media` directory (for storing PDFs) in document root
3. Create `thumb` directory (for storing PHP-generated thumbnails) in document root
4. Upload PDFs to `media` directory using SFTP or the like

Note that the page may take a long time to load on first usage as it generates
thumbnails for the first time. If the page stalls, continue reloading it until
all necessary thumbnails have been generated.
