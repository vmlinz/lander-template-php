<?php
// Disable all error reporting
//ini_set('error_reporting', 0);

// Importing libraries
require_once dirname(__FILE__) . '/vendor/autoload.php';
// Importing config file
require_once dirname(__FILE__) . '/config.php';
// Importing our service functions
require_once dirname(__FILE__) . '/lib.php';

// Default content location
$content_path = 'content/';

// Load mobile detection library
use Detection\MobileDetect;

// Detecting mobile devices and rendering mobile version if needed
if (ACLandingConfig::DETECT_MOBILE) {
    $detect = new MobileDetect;
    if (file_exists(dirname(__FILE__) . '/content/mobile') && $detect->isMobile()) {
        $content_path = 'content/mobile/';
    }
}

// Rendering index of our content
Render_Template($content_path);
