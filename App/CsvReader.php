<?php

namespace App;

use App\Models\User;
use Exception;

class CSVReader {

    public function __construct(protected string $filePath, protected string $delimiter) {
    }

    /**
     * @throws \Exception
     */
    public function getUsers(): array
    {
        $users = [];
        if (($handle = fopen($this->filePath, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE) {
                if(count($data) < 2) throw new Exception('Неверный формат данных');
                $id = $data[0];
                $users[$id] = new User($id, $data[1]);
            }
            fclose($handle);
        }
        return $users;
    }
}
