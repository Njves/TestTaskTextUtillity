<?php

$peopleCsvContent = "1;Sergey Dorohov\n2;Anna Petrova\n3;Ivan Ivanov\n";
file_put_contents('./people.csv', $peopleCsvContent);

if (!is_dir('./texts')) {
    mkdir('./texts', 0777, true);
}

// Создаем текстовые файлы для пользователей
$textFiles = [
    '1-001.txt' => "This is the first text file for Sergey Dorohov.\nDate of meeting: 15/03/23\nAnother date: 01/01/22\n",
    '1-002.txt' => "Second file content for Sergey Dorohov.\nMeeting on 10/10/23 was successful.\n",
    '2-001.txt' => "First file for Anna Petrova.\nBirthday: 25/12/20\n",
    '3-001.txt' => "Ivan Ivanov's text file.\nProject deadline: 05/05/24\n",
    '3-002.txt' => "Second file for Ivan Ivanov.\nMeeting scheduled for 07/07/22.\n"
];

foreach ($textFiles as $fileName => $content) {
    file_put_contents("./texts/$fileName", $content);
}

echo "Files generated successfully.\n";
