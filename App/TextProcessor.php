<?php

namespace App;

use Carbon\Carbon;

class TextProcessor {

    public function __construct(protected string $textsDir, protected string $outputDir) {
    }

    public function countAverageLineCount($userId): float
    {
        $files = glob($this->textsDir . "/{$userId}-*.txt");
        $totalLines = 0;
        $fileCount = count($files);
        foreach ($files as $file) {
            $lines = file($file, FILE_IGNORE_NEW_LINES);
            $totalLines += count($lines);
        }
        return $fileCount > 0 ? $totalLines / $fileCount : 0;
    }

    public function replaceDates($userId): int
    {
        $files = glob($this->textsDir . "/{$userId}-*.txt");
        $totalReplacements = 0;
        $this->createOutputDirectory();
        foreach ($files as $file) {
            $this->processFile($file, $totalReplacements);
        }

        return $totalReplacements;
    }

    private function processFile(string $file, int &$totalReplacements): void {
        $content = file_get_contents($file);
        $replacedContent = preg_replace_callback(
            '/(\d{2})\/(\d{2})\/(\d{2})/',
            function ($matches) {
                return Carbon::createFromFormat('d/m/y', $matches[0])->format('m-d-Y');
            },
            $content,
            -1,
            $count
        );
        $totalReplacements += $count;


        $outputFile = $this->outputDir . '/' . basename($file);
        file_put_contents($outputFile, $replacedContent);
    }

    private function createOutputDirectory() : void
    {
        if (!file_exists($this->outputDir)) {
            mkdir($this->outputDir, 0777, true);
        }
    }
}