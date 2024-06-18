<?php
require_once 'vendor\autoload.php';

use App\CSVReader;
use App\UserManager;
use App\TextProcessor;

if ($argc != 3) {
    echo "Usage: php user_text_util.php [comma|semicolon] [countAverageLineCount|replaceDates]\n";
    exit(1);
}

$delimiterType = $argv[1];
$taskType = $argv[2];

$delimiter = $delimiterType === 'comma' ? ',' : ';';
$csvFilePath = './people.csv';

$csvReader = new CSVReader($csvFilePath, $delimiter);
$users = $csvReader->getUsers();

$userManager = new UserManager($users);
$textProcessor = new TextProcessor('./texts', './output_texts');

switch ($taskType) {
    case 'countAverageLineCount':
        $userManager->countAverageLineCount($textProcessor);
        break;
    case 'replaceDates':
        $userManager->replaceDates($textProcessor);
        break;
    default:
        echo "Invalid task type. Use countAverageLineCount or replaceDates.\n";
        exit(1);
}