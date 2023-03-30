<?php
    function importFile($file)
    {
        $doc = new DOMDocument();
        $doc->formatOutput = true;
        $doc->preserveWhiteSpace = false;
        $doc->load($file);

        return $doc;
    }

    function saveAs($imported, $savedName): void
    {
        $imported->save($savedName);
    
        // No Break line fixes
        $imported = importFile($savedName);
        $imported->save($savedName);
    
        echo "Saved as \"{$savedName}\"\n";
    }

    function updateDTD($imported)
    {
        $importedRoot = $imported->documentElement;
        $imp = new DOMImplementation;
        $dtd = $imp->createDocumentType(
            'article',
            '-//NLM//DTD JATS (Z39.96) Journal Publishing DTD with MathML3 v1.3 20210610//EN',
            'JATS-journalpublishing1-3-mathml3.dtd'
        );
        $imported = $imp->createDocument("", "", $dtd);
        $imported->encoding = 'UTF-8';
        $node = $imported->importNode($importedRoot, true);
        $imported->appendChild($node);

        echo "DTD updated to 1.3";

        return $imported;
    }

    function incrementalDuplicationFix($imported, $elementName, $attributeName)
    {
        $intArray = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $importedRoot = $imported->documentElement;
        $increment = 0;

        // Look for integer in attribute value to find separation position between string and integer
        foreach ($importedRoot->getElementsByTagName($elementName)->item(0)->getAttribute($attributeName) as $str) {
            if (in_array($str, $intArray)) {
                $separatorPosition = strpos($importedRoot->getElementsByTagName($elementName)->item(0)->getAttribute($attributeName), $str);
            }
        }

        foreach ($importedRoot->getElementsByTagName($elementName) as $elementTag) {
            $string = substr($elementTag->getAttribute($attributeName), 0, $separatorPosition);
            $increment++;
    
            $setAttribute = "{$string}{$increment}";
    
            $elementTag->setAttribute($attributeName, $setAttribute);
        }

        return "<{$elementName}> Duplication Fixed";
    }

// ----------------------------------------------------------------------------------------------------------------------------------------------//
    
    echo "Welcome to JATS fixer\n";
    $fileName = readline("Enter filename: ");
    $imported = importFile($fileName);
    
    while (true) {
        echo <<<INFO
        --------------------------------
        Available option
        1. Incremental duplication fix
        2. Update DTD to 1.3
        3. saveAs
        --------------------------------

        INFO;
        $function = readline("Select option: ");
        switch ($function) {
            case '1':
                $elementName = readline("Element name: ");
                $attributeName = readline("Attribute name: ");
                incrementalDuplicationFix($imported, $elementName, $attributeName);
                break;

            case '2':
                $imported = updateDTD($imported);
                break;

            case '3':
                $savedName = readline("Save as: ");
                saveAs($imported, $savedName);
                exit;
                break;
            
            default:
                echo "Please select available numbers\n";
                break;
        }
    }
?>