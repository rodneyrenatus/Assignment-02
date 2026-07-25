<?php
// Path to the folder where JSON data files are stored
$data_dir = __DIR__ . "/data";

// Save one submission to a JSON file
function save_submission($filename, $data) {
    global $data_dir;
    if (!is_dir($data_dir)) {
        mkdir($data_dir, 0755, true);
    }
    $filepath = $data_dir . "/" . $filename;
    $all      = load_submissions($filename);
    $data["timestamp"] = date("Y-m-d H:i:s");
    $all[]    = $data;
    file_put_contents($filepath, json_encode($all, JSON_PRETTY_PRINT));
}

// Load all submissions from a JSON file
function load_submissions($filename) {
    global $data_dir;
    $filepath = $data_dir . "/" . $filename;
    if (!file_exists($filepath)) {
        return [];
    }
    $decoded = json_decode(file_get_contents($filepath), true);
    return is_array($decoded) ? $decoded : [];
}

// Count submissions in a file
function count_submissions($filename) {
    return count(load_submissions($filename));
}
?>
