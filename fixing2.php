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

    function addOrReplaceElementAttribute($imported, $elementName, $includeNamespace, $attributeName, $attributeValue, $runType, ?string $designatedValue): void
    {
        // Note: Could have numerous elements not only one
        $importedRoot = $imported->documentElement;

        switch ($runType) {
            // Replace all corresponding elements
            case '1':
                // Check if its include a namespace
                if (strtoupper($includeNamespace) == 'Y') {
                    // check if its root element
                    if ($elementName == 'article') {
                        $importedRoot->setAttributeNS(
                            'http://www.w3.org/2000/xmlns/',
                            "xmlns:{$attributeName}",
                            $attributeValue
                        );
                    } else {
                        foreach ($importedRoot->getElementsByTagName($elementName) as $elementTag) {
                            $elementTag->setAttributeNS(
                                'http://www.w3.org/2000/xmlns/',
                                "xmlns:{$attributeName}",
                                $attributeValue
                            );
                        }
                    }
                } else {
                    if ($elementName == 'article') {
                        $importedRoot->setAttribute($attributeName, $attributeValue);
                    } else {
                        foreach ($importedRoot->getElementsByTagName($elementName) as $elementTag) {
                            $elementTag->setAttribute($attributeName, $attributeValue);
                        }
                    }
                }
                break;
            
            // Replace only the same attribute name
            case '2':
                // Check if its include a namespace
                if (strtoupper($includeNamespace) == 'Y') {
                    // check if its root element
                    if ($elementName == 'article') {
                        $importedRoot->setAttributeNS(
                            'http://www.w3.org/2000/xmlns/',
                            "xmlns:{$attributeName}",
                            $attributeValue
                        );
                    } else {
                        foreach ($importedRoot->getElementsByTagName($elementName) as $elementTag) {
                            if ($elementTag->hasAttribute($attributeName)) {
                                $elementTag->setAttributeNS(
                                    'http://www.w3.org/2000/xmlns/',
                                    "xmlns:{$attributeName}",
                                    $attributeValue
                                );
                            }
                        }
                    }
                } else {
                    if ($elementName == 'article') {
                        $importedRoot->setAttribute($attributeName, $attributeValue);
                    } else {
                        foreach ($importedRoot->getElementsByTagName($elementName) as $elementTag) {
                            if ($elementTag->hasAttribute($attributeName)) {
                                $elementTag->setAttribute($attributeName, $attributeValue);
                            }
                        }
                    }
                }
                break;

            case '3':
                // Check if its include a namespace
                if (strtoupper($includeNamespace) == 'Y') {
                    // check if its root element
                    if ($elementName == 'article') {
                        $importedRoot->setAttributeNS(
                            'http://www.w3.org/2000/xmlns/',
                            "xmlns:{$attributeName}",
                            $attributeValue
                        );
                    } else {
                        foreach ($importedRoot->getElementsByTagName($elementName) as $elementTag) {
                            if ($elementTag->hasAttribute($attributeName) && $elementTag->getAttribute($attributeName) == $designatedValue) {
                                $elementTag->setAttributeNS(
                                    'http://www.w3.org/2000/xmlns/',
                                    "xmlns:{$attributeName}",
                                    $attributeValue
                                );
                            }
                        }
                    }
                } else {
                    if ($elementName == 'article') {
                        $importedRoot->setAttribute($attributeName, $attributeValue);
                    } else {
                        foreach ($importedRoot->getElementsByTagName($elementName) as $elementTag) {
                            if ($elementTag->hasAttribute($attributeName) && $elementTag->getAttribute($attributeName) == $designatedValue) {
                                $elementTag->setAttribute($attributeName, $attributeValue);
                            }
                        }
                    }
                }
                break;
            
            default:
                # code...
                break;
        }
    }

    function addElement($imported, $appendingElementName, $runType, $designatedElement, ?string $firstOrLastChild): void
    {
        $importedRoot = $imported->documentElement;
        $designatedElement = $importedRoot->getElementsByTagName($designatedElement);

        switch ($runType) {
            case '1':
                switch ($firstOrLastChild) {
                    case '1':
                        // check if its root element
                        if ($designatedElement == 'article') {
                            $importedRoot->insertBerfore(
                                $appendingElementName,
                                $importedRoot->firstChild
                            );
                        } else {
                            foreach ($designatedElement as $elementTag) {
                                $designatedElement->insertBefore(
                                    $appendingElementName,
                                    $designatedElement->firstChild
                                );
                            }
                        }
                        break;
                    
                    default:
                        // check if its root element
                        if ($designatedElement == 'article') {
                            $importedRoot->appendChild($appendingElementName);
                        } else {
                            foreach ($designatedElement as $elementTag) {
                                $designatedElement->appendChild($appendingElementName);
                            }
                        }
                        break;
                }
                break;
            
            case '2':
                // check if its root element
                if ($designatedElement->item(0)->parentNode == null) {
                    $importedRoot->insertBerfore(
                        $appendingElementName,
                        $designatedElement
                    );
                } else {
                    $parents = $designatedElement->parentNode;
                    foreach ($parents as $parent) {
                        $parent->insertBerfore(
                            $appendingElementName,
                            $designatedElement
                        );
                    }
                }
                break;
            
            default:
                # code...
                break;
        }
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

    function incrementalAttributeFix($imported, $elementName, $attributeName, $attributeValue): void
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

        echo "{$attributeName} Duplication Fixed";
    }

// ----------------------------------------------------------------------------------------------------------------------------------------------//
    // Prompt starts here
    echo "Welcome to JATS fixer\n";
    while (true) {
        $fileName = readline("Masukan nama file: ");
        $imported = importFile($fileName);
        if (error_get_last()) {
            echo "\033[031mNama file tidak valid\nMohon masukan nama file yang benar beserta ekstensinya (.xml)\033[0m\n";
            error_clear_last();
        } else {
            break;
        }
    }
    
    while (true) {
        echo <<<INFO

        ---------------------------------------
        Opsi tersedia
        1. Perbaiki increment nilai attribute
        2. Update DTD ke 1.3
        3. Tambah element
        4. Tambah atau ganti attribute element
           beserta Nilainya
        5. Save as
        ---------------------------------------
        \n
        INFO;
        $function = readline("Select option: ");
        switch ($function) {
            case '1':
                echo <<<INFO
                -----------------------------------------

                Opsi ini memperbaiki masalah incremental
                \033[33m(contoh-1, contoh-2, contoh-3)\033[0m pada nilai
                attribute, seperti;

                - Duplikasi angka pada nilai attribute
                  \033[33m(contoh-1, contoh-1, contoh-2)\033[0m
                - Menambahkan angka pada nilai atribute
                  yang terduplikasi dan tanpa angka
                  \033[33m(contoh, contoh, contoh)\033[0m

                -----------------------------------------
                \n
                INFO;
                echo "<\033[92melement-name\033[0m attribute-name=\"attribute-value\">\n";
                $elementName = readline("Element name: ");
                echo "<{$elementName} \033[92mattribute-name \033[0m=\"\">\n";
                $attributeName = readline("Attribute name: ");
                echo <<<INFO
                ----------------------------------------
                nilai attribute yang dimasukan dapat
                beserta maupun tanpa angka, contoh;
                - contoh-6
                - contoh6
                - contoh-
                - contoh
                to assign incremental to duplicated
                non-number attribute please do not
                include number since it has no number.
                ----------------------------------------
                \n
                INFO;
                echo "<{$elementName} {$attributeName}=\"\033[92mattribute-value\033[0m\">\n";
                $attributeValue = readline("Attribute value: ");
                incrementalAttributeFix($imported, $elementName, $attributeName, $attributeValue);
                break;

            case '2':
                $imported = updateDTD($imported);
                break;
            
            
            case '3':
                $firstOrLastChild = null;
                echo <<<INFO
                ------------------------------------------------------
                Opsi ini digunakan untuk menambahkan element pada tiap
                element yang ditentukan

                \033[92m<ini-element>
                </ini-element>\033[0m

                1. Masukan dalam element yang ditentukan
                2. Masukan di sebelum element yang ditentukan
                ------------------------------------------------------
                \n
                INFO;
                $runType = readline("Tipe running: ");
                if ($runType == '1') {
                    $designatedElement = readline("Dalam element apa: ");
                    $appendingElementName = readline("Nama element yang ingin dimasukan: ");
                    echo <<<INFO
                    ------------------------------------------------
                    Note:
                    Jika element yang diisi tidak memiliki element
                    alias kosong, maka akan terisi seperti biasa
                    
                    Contoh pada posisi pertama:

                    <ini-element>
                        \033[92m<{$appendingElementName}>
                        </{$appendingElementName}>\033[0m
                        <element-yang-sudah-ada>
                        </element-yang-sudah-ada>
                    </ini-element>
                    
                    1. Masukan di posisi pertama
                    2. Masukan di posisi terakhir
                    -------------------------------------------------
                    \n
                    INFO;
                    $firstOrLastChild = readline("Posisi: ");
                }
                if ($runType == '2') {
                    $designatedElement = readline("Sebelum element apa: ");
                    $appendingElementName = readline("Nama element yang ingin dimasukan: ");
                }
                addElement($imported, $appendingElementName, $runType, $designatedElement, $firstOrLastChild);
                break;
            
            // Add or replace attribute
            case '4':
                $designatedValue = null;
                echo <<<INFO
                -------------------------------------------------------------------------
                Opsi ini akan menambahkan attribute baru atau
                secara otomatis menimpa attribute dengan nama
                yang sama

                <element \033[92mini-attribute\033[0m="\033[92mnilai-attribute\033[0m">
                </element>

                1. Tambah dan timpa semua element yang disebutkan
                2. Timpa hanya nama attribute yang sama
                3. Timpa hanya pada nilai attribute yang ditentukan
                -------------------------------------------------------------------------
                \n
                INFO;
                $runType = readline("Tipe running: ");
                if ($runType == '3') {
                    $designatedValue = readline("Nilai attribute yang akan ditimpa: ");
                }
                echo <<<INFO

                gunakan namespace \033[92mxmlns\033[0m?

                \033[92mxmlns\033[0m:nama-attribute="nilai-attribute"

                Y/N
                \n
                INFO;
                $includeNamespace = readline("Gunakan: ");
                if (strtoupper($includeNamespace) == 'Y') {
                    $xmlnsStr = 'xmlns:';
                } else {
                    $xmlnsStr = '';
                }
                echo "<\033[92melement-name\033[0m {$xmlnsStr}attribute-name=\"attribute-value\">\n";
                $elementName = readline("Nama element: ");
                echo "<{$elementName} {$xmlnsStr}\033[92mattribute-name \033[0m=\"\">\n";
                $attributeName = readline("Nama Attribute: ");
                echo "<{$elementName} {$xmlnsStr}{$attributeName}=\"\033[92mattribute-value\033[0m\">\n";
                $attributeValue = readline("Nilai attribute: ");
                addOrReplaceElementAttribute(
                    $imported,
                    $elementName,
                    $includeNamespace,
                    $attributeName, 
                    $attributeValue,
                    $runType,
                    $designatedValue
                );
                break;

            case '5':
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