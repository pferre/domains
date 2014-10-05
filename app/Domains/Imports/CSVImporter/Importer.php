<?php

namespace Domains\Imports\CSVImporter;


class Importer  {

    /**
     * @var string
     */
    private $file = "/Users/fred/Downloads/123domains.csv";

    /**
     * @return mixed
     */
    public function import()
    {
        $csvData = [];

        if (($handle = fopen($this->file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, "|")) !== FALSE) {
                $csvData[] = $data;
            }
            fclose($handle);
        }

        print_r($csvData[1]);

    }
}