<?php

trait FileReadable
{
    /**
     * @throws FileReaderException
     */
    final function getCSV(string $path, $withHeader = true): array
    {
        $file = fopen($path, "r");
        if (!$file)
            throw new FileReaderException('Invalid file path.');

        $rows = [];
        while (!feof($file))
            $rows[] = fgetcsv($file);

        fclose($file);

        $fileData = ['filename' => basename($path)];
        if ($withHeader) {
            $fileData['header'] = $rows[0] ?? [];
            array_shift($rows);
        }

        $fileData['rows'] = $rows;

        return $fileData;
    }

}
