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

        echo "DTD updated to 1.3\n";

        return $imported;
    }

    function incrementalAttributeFix($imported, $elementName, $attributeName, $attributeValue)
    {
        $intArray = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $importedRoot = $imported->documentElement;
        $increment = 0;

        // Look for integer in attribute value to find separation position between string and integer
        foreach (str_split($attributeValue) as $str) {
            if (in_array($str, $intArray)) {
                $separatorPosition = strpos($attributeValue, $str);
                break;
            }
        }

        // Check if the given $attributeValue has number
        if (isset($separatorPosition)) {
            $string = substr($attributeValue, 0, $separatorPosition);
        } else {
            $string = $attributeValue;
        }

        // Fix the incremental
        foreach ($importedRoot->getElementsByTagName($elementName) as $elementTag) {
            if ($elementTag->hasAttribute($attributeName)) {
                if (str_contains($elementTag->getAttribute($attributeName), $string)) {
                    $increment++;
            
                    $setAttribute = "{$string}{$increment}";
            
                    $elementTag->setAttribute($attributeName, $setAttribute);
                }
            }
        }

        return "{$attributeName} Duplication Fixed";
    }

// ----------------------------------------------------------------------------------------------------------------------------------------------//
    
    echo "Welcome to JATS fixer\n";
    $fileName = readline("Enter filename: ");
    $imported = importFile($fileName);
    
    while (true) {
        echo <<<INFO
        --------------------------------
        Available option
        1. Increment attribute value
        2. Update DTD to 1.3
        3. Add or replace element attribute
        4. Save as
        --------------------------------

        INFO;
        $function = readline("Select option: ");
        switch ($function) {
            case '1':
                echo <<<INFO
                ----------------------------------------
                This option fix the incremental problem;
                - Number duplication
                - Assign incremental number to existing
                  attributes
                ----------------------------------------
        
                INFO;
                $elementName = readline("Element name: ");
                $attributeName = readline("Attribute name: ");
                echo <<<INFO
                ----------------------------------------
                You can enter the attribute value
                with or without the number, example;
                - value-6
                - value6
                - value-
                - value
                to assign incremental to non-number
                attribute please do not include number
                since it has no number.
                ----------------------------------------
        
                INFO;
                $attributeValue = readline("Attribute value: ");
                incrementalAttributeFix($imported, $elementName, $attributeName, $attributeValue);
                break;

            case '2':
                $imported = updateDTD($imported);
                break;

            case '3':
                ;
                break;

            case '4':
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