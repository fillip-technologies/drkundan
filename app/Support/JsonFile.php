<?php

namespace App\Support;

use JsonException;

/**
 * Reads a JSON data file without throwing, so a missing or malformed file
 * can be reported instead of taking the whole website down.
 */
class JsonFile
{
    /**
     * Decode the file at $path. Returns null and sets $error when it cannot be read.
     */
    public static function read(string $path, ?string &$error = null): ?array
    {
        $error = null;

        if (! is_file($path)) {
            $error = 'file not found';

            return null;
        }

        try {
            $data = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $error = 'invalid JSON ('.$e->getMessage().')';

            return null;
        }

        if (! is_array($data)) {
            $error = 'expected a JSON object or list';

            return null;
        }

        return $data;
    }
}
