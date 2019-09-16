<?php
// Importing config
require_once dirname(__FILE__) . '/config.php';
// Importing our service functions
require_once dirname(__FILE__) . '/lib.php';

// Get POST data
$data = Send_Order($_REQUEST);
$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$pixel_code = '';
$success = '';
// API response. We'll render it in HTML code
$response = json_encode($data);
if ($data['code'] == 'ok') {
    // Don't render pixel if order is_double
    if (!$data['is_double']) {
        $pixel_code = ACLandingConfig::PIXEL_CODE;
    }
    // Successful order text
    $success = <<<EOV
        <!--pixel start-->
        $pixel_code
        <!--pixel end-->
        <div class="mod success-page">
            <div class="container">
                <h2 class="success-page__title">Thank you for order!</h2>
        
                <p class="success-page__message_success">We will contact you soon, please keep your phone on.</p>
        
                <h3 class="success-page__text">Please check, you information.</h3>
        
                <div class="list-info">
                    <ul class="list-info__list">
                        <li class="list-info__item">
                            <span class="list-info__text">Name: </span>
                            $name
                        </li>
                        <li class="list-info__item">
                            <span class="list-info__text">Telephone: </span>
                            $phone
                        </li>
                    </ul>
                </div>
        
                <p class="success-page__message_fail">
                    <a class="success-page__message_fail__link" href="#" onclick="GoBackWithRefresh();return false;">
                        If you filled form wrong, you can go back and correct form.
                    </a>
                </p>
            </div>
        </div>
        <!--
        Order request response: 
        $response
        -->
EOV;
} else {
    http_response_code(400);
    // Error text
    $success = <<<EOV
    <div class="mod success-page">
        <div class="container">
            <h2 class="success-page__title">Unknown error! Please try again!</h2>
            <p class="success-page__message_fail">
                <a class="success-page__message_fail__link" href="#" onclick="GoBackWithRefresh();return false;">
                    ← Go back
                </a>
            </p>
        </div>
    </div>
    <!--
    Order request response: 
    $response
    -->
EOV;

}

// Success page main text
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Creating order</title>
    <meta charset="utf-8">
    <meta name="robots" content="none">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        function GoBackWithRefresh(event) {
            if ('referrer' in document) {
                window.location = document.referrer;
                /* OR */
                //location.replace(document.referrer);
            } else {
                window.history.back();
            }
        }
    </script>
    <style type="text/css">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        body {
            margin: 0;
        }

        article,
        aside,
        footer,
        header,
        nav,
        section {
            display: block;
        }

        h1 {
            font-size: 2em;
            margin: 0.67em 0;
        }

        figcaption,
        figure,
        main {
            display: block;
        }

        figure {
            margin: 1em 40px;
        }

        hr {
            box-sizing: content-box;
            height: 0;
            overflow: visible;
        }

        pre {
            font-family: monospace, monospace;
            font-size: 1em;
        }

        a {
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }

        a:active,
        a:hover {
            outline-width: 0;
        }

        abbr[title] {
            border-bottom: none;
            text-decoration: underline;
        }

        b,
        strong {
            font-weight: inherit;
        }

        b,
        strong {
            font-weight: bolder;
        }

        code,
        kbd,
        samp {
            font-family: monospace, monospace;
            font-size: 1em;
        }

        dfn {
            font-style: italic;
        }

        mark {
            background-color: #ff0;
            color: #000;
        }

        small {
            font-size: 80%;
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline;
        }

        sub {
            bottom: -0.25em;
        }

        sup {
            top: -0.5em;
        }

        audio,
        video {
            display: inline-block;
        }

        audio:not([controls]) {
            display: none;
            height: 0;
        }

        img {
            border-style: none;
        }

        svg:not(:root) {
            overflow: hidden;
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: sans-serif;
            font-size: 100%;
            line-height: 1.15;
            margin: 0;
        }

        button,
        input {
            overflow: visible;
        }

        button,
        select {
            text-transform: none;
        }

        button,
        html [type="button"],
        [type="reset"],
        [type="submit"] {
            -webkit-appearance: button;
        }

        button::-moz-focus-inner,
        [type="button"]::-moz-focus-inner,
        [type="reset"]::-moz-focus-inner,
        [type="submit"]::-moz-focus-inner {
            border-style: none;
            padding: 0;
        }

        button:-moz-focusring,
        [type="button"]:-moz-focusring,
        [type="reset"]:-moz-focusring,
        [type="submit"]:-moz-focusring {
            outline: 1px dotted ButtonText;
        }

        fieldset {
            border: 1px solid #c0c0c0;
            margin: 0 2px;
            padding: 0.35em 0.625em 0.75em;
        }

        legend {
            box-sizing: border-box;
            color: inherit;
            display: table;
            max-width: 100%;
            padding: 0;
            white-space: normal;
        }

        progress {
            display: inline-block;
            vertical-align: baseline;
        }

        ol, ul {
            list-style: none;
        }

        textarea {
            overflow: auto;
        }

        [type="checkbox"],
        [type="radio"] {
            box-sizing: border-box;
            padding: 0;
        }

        [type="number"]::-webkit-inner-spin-button,
        [type="number"]::-webkit-outer-spin-button {
            height: auto;
        }

        [type="search"] {
            -webkit-appearance: textfield;
            outline-offset: -2px;
        }

        [type="search"]::-webkit-search-cancel-button,
        [type="search"]::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit;
        }

        details,
        menu {
            display: block;
        }

        summary {
            display: list-item;
        }

        canvas {
            display: inline-block;
        }

        template {
            display: none;
        }

        [hidden] {
            display: none;
        }

        .success-page {
            line-height: 1;
            height: 100%;
            font-family: Arial, serif;
            font-size: 15px;
            color: #313e47;
            width: 100%;
            background: #fff;
            position: fixed;
            z-index: 99999;
            top: 0;
            left: 0;
            overflow: scroll;
        }

        .container {
            max-width: 960px;
            padding: 70px 30px 70px 30px;
            margin: 0 auto;
        }

        .success-page__message_success {
            text-align: center;
        }

        .success-page__message_fail {
            margin: 25px 0 50px 0;
            text-align: center;

        }

        .list-info {
            text-align: center;
        }

        .list-info__list {
            text-align: left;
            display: inline-block;
            padding: 0;
        }

        .list-info__item {
            margin: 11px 0;
        }

        .list-info__text {
            width: 150px;
            display: inline-block;
            font-weight: bold;
            font-style: normal;
        }

        .success-page__title {
            font-size: 28px;
            line-height: 44px;
            color: #313e47;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
        }

        .success-page__text {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        .success-page__message_fail__link {
            color: #69B9FF;
        }

        .success-page__message_fail__link:hover {
            color: #e14740;
        }

        @media (max-width: 320px) {
            .list-info__text {
                display: block;
            }
        }
    </style>
</head>
<body>
<?php
echo $success;
?>

</body>
</html>
