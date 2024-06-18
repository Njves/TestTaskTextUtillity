<?php

namespace App;

class UserManager {

    public function __construct(private $users) {
    }

    public function countAverageLineCount($textProcessor): void
    {
        foreach ($this->users as $user) {
            $average = $textProcessor->countAverageLineCount($user->id);
            echo $user->name . ": " . $average . " lines\n";
        }
    }

    public function replaceDates($textProcessor): void
    {
        foreach ($this->users as $user) {
            $replacements = $textProcessor->replaceDates($user->id);
            echo $user->name . ": " . $replacements . " replacements\n";
        }
    }
}