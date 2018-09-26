<?php

namespace App\Formatter;

use App\Formatter\CSVFileFormatter;


/**
 * Description of RegisteredUsersCSVExportFormatter
 *
 * @author rimaz
 */
class RegisteredUsersCSVExportFormatter extends CSVFileFormatter {
    
    public function getCSVData($objData) {
        $fp = fopen('php://temp', 'r+');
        fputcsv($fp, $this->getCSVHeaderRow());

        foreach ($objData as $client) {
            $row = array();
            $row[] = $client->getCompany();
            $row[] = $client->getCountryCode();
            $row[] = $client->getFirstName();
            $row[] = $client->getLastName();
            $row[] = $client->getUsername();
            $row[] = $client->getUserEmail();
            $row[] = $client->getTelephone();
            $row[] = $client->getEmpCount();
            $row[] = $client->getDate();
            fputcsv($fp, $row);
        }
        rewind($fp);
        $csv = stream_get_contents($fp);
        fclose($fp);
        return $csv;
    }
    
    public function getCSVHeaderRow() {
        return array("Company", "Country", "First Name", "Last Name", "Username",
            "Email", "Telephone", "Employee Count", "Date Registered");
    }
    
    public function getFileName() {
        return "open_source_client_list_" . date("Y-m-d-His") . $this->getFileExtension();
    }
}
