<?php
require_once __DIR__ . '/../config/config.php';
function define_url($path = "") {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";

    // Lấy đường dẫn gốc theo DOCUMENT_ROOT
    $documentRoot = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']));

    // Lấy thư mục project
    $projectRoot = str_replace('\\', '/', realpath(__DIR__ . '/..'));

    // Tính URL path của project
    $basePath = str_replace($documentRoot, '', $projectRoot);

    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $basePath . "/" . ltrim($path, "/");
}

function redirectHome(){
    $home_page = define_url(HOME_PAGE);
    header('Location: '.$home_page);
}

function load_css($filePaths = [])
{
    $html = "";
    foreach ($filePaths as $filePath) {
        $html .= '<link rel="stylesheet" href="' . define_url($filePath) . '">' . "\n";
    }

    return $html;
}

function load_script($filePaths = [])
{
    $html = "";
    foreach ($filePaths as $filePath) {

        $html .= '<script src="' . define_url($filePath) . '"></script>' . "\n";
    }

    return $html;
}

function normalizeOptions($options) {
    // Ép về array (phòng trường hợp stdClass)
    $options = json_decode(json_encode($options), true);

    // Sắp xếp theo optionId
    usort($options, function ($a, $b) {
        return $a[0] <=> $b[0];
    });

    return $options;
}