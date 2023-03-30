<?php
    function importFile($file){
        $doc = new DOMDocument();
        $doc->formatOutput = true;
        $doc->preserveWhiteSpace = false;
        $doc->load($file);

        return $doc;
    }

    function duplicationFix($imported){
        $importedRoot = $imported->documentElement;
        $increment = 0;
        foreach ($importedRoot->getElementsByTagName('sup') as $supTag) {
            if (str_contains($supTag->getAttribute('id'), '_')) {
                $stripPosition = strpos($supTag->getAttribute('id'), '-');
        
                $string = substr($supTag->getAttribute('id'), 0, $stripPosition);
                $increment++;
        
                $setAttribute = "{$string}-{$increment}";
        
                $supTag->setAttribute('id', $setAttribute);
            }
        }

        return "Duplication Fixed";
    }
    
    echo "Welcome to JATS fixer\n";
    $fileName = readline("Masukan nama file: \n");
    importFile($fileName);
    
    while (true) {
        echo <<<INFO
        Available option
        1.
        2.

        INFO;
        $function = readline("Select option: \n");
        switch ($function) {
            case '1':
                echo "Dayum\n";
                break;
            
            default:
                # code...
                break;
        }
    }
?>