<?php

namespace App\Traits;

use App\Exceptions\AppException;
use Closure;

trait FileRunnerTrait
{
    /**
     * @param string $fileName
     * @param Closure $lineHandler
     * @throws AppException
     * @throws \Throwable
     */
    public function runFile(string $fileName, Closure $lineHandler) {
        if (!file_exists($fileName)) {
            throw new AppException('file ' . $fileName . ' not exists');
        }

        $handle = fopen($fileName, "r");

        if (!$handle) {
            throw new AppException("can't open file to read: " . $fileName);
        }

        try {
            while (($line = fgets($handle)) !== false) {
                $lineHandler($line);
            }
        } catch (\Throwable $e) {
            fclose($handle);
            throw $e;
        } finally {
            fclose($handle);
        }
    }
}