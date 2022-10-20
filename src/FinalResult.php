<?php


class FinalResult
{
    use FileReadable;

    /**
     * @param $filePath
     * @return array
     * @throws FileReaderException
     */
    function results($filePath): array
    {
        //get file data
        $fileData = $this->getCSV($filePath);

        //reformat and get result
        $result = (new ResultMapService())->getResult($fileData);

        //return final result data
        return [
            "filename" => $fileData['filename'],
            "failure_code" => $fileData['header'][1],
            "failure_message" => $fileData['header'][2],
            "records" => $result
        ];
    }
}

?>
