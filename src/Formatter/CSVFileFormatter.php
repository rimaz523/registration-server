<?php

namespace App\Formatter;

/**
 * Description of CSVFileFormatter
 *
 * @author rimaz
 */
abstract class CSVFileFormatter {

    const CSV_FILE_EXTENSION = ".csv";
    const CONTENT_TYPE = "text/csv";

    abstract public function getCSVData($objData);

    abstract public function getCSVHeaderRow();

    abstract public function getFileName();

    public function getFileExtension() {
        return self::CSV_FILE_EXTENSION;
    }

    public function getContentType() {
        return self::CONTENT_TYPE;
    }

}
