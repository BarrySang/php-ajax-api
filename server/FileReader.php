<?php declare(strict_types=1);

class FileReader {
    // properties
    private $filename, $words, $results = array();

    // methods
    function __construct(string $filename, array $words) {
        $this->filename = $filename;
        $this->words = $words;
    }

    // read file and search for the word
    public function wordSearch() {
        // open file
        $file = fopen($this->filename, "r") or die("Unable to open file.");

        // while loop to get every line in the file
        while(!feof($file)) {

            // store the current line in a iable
            $line = fgets($file);

            // for each loop to check each presence of each word in every line
            if($line != "") {

            
                foreach($this->words as $word) {

                    // check if the line contains the required word
                    if(str_contains($line, $word)) {
                        
                        // add line to $this->results array if it contains the word being looked for
                        ($this->addResult($line));
                    }
                }
            }
        }

        return $this->keyValueArray($this->results, "=");
    }

    // add item to $results array
    private function addResult(string $result) {
        
        array_push($this->results, $result);
        
    }

    // function to convert string in file to key-value pairs
    private function keyValueArray(array $stringArray, $separator) {

        
        // array to hold the changed values
        $newArray = array();

        // loop through each element in the array and change the values as required
        foreach($stringArray as $string) {

            
            // get position of the separator
            $separatorPosition = strpos($string, $separator);

            // get value and key from the string
            $value = trim(substr($string, $separatorPosition + 1));
            $key = trim(str_replace("=" . $value, "", $string));
            
            // push the key-value pair to the associative array
            $newArray[$key] = $value;
            
        }

        return $newArray;
    }
}