<?php
    $requiredElements = [
        'front' => [
            'journal-meta' => [
                'journal-id' => null,
                'journal-title-group' => [
                    'journal-title' => null
                ],
                'issn' => null,
                'publisher' => [
                    'publisher-name' => null
                ]
            ],
            'article-meta' => [
                'article-categories' => [
                    'subj-group' => [
                        'subject' => null
                    ]
                ],
                'title-group' => [
                    'article-title' => null
                ],
                'contrib-group' => [
                    'contrib' => [
                        'name' => [
                            'surname' => null,
                            'given-names' => null
                        ],
                        'email' => null,
                        'xref' => null
                    ]
                ],
                'aff' => null,
                'pub-date' => [
                    'year' => null
                ],
                'elocation-id' => null,
                'history' => [
                    'date' => [
                        'year' => null
                    ]
                ]
            ],
        ]
    ];
    // $requiredElements = [
    //     ['front',[
    //         ['journal-meta', [
    //             ['journal-id'],
    //             ['journal-title-group', [
    //                 ['journal-title']]],
    //             ['issn'],
    //             ['publisher', [
    //                 ['publisher-name']]]]],
    //         ['article-meta', [
    //             ['article-categories', [
    //                 ['subj-group', [
    //                     ['subject']]]]],
    //             ['title-group', [
    //                 ['article-title']]],
    //             ['contrib-group', [
    //                 ['contrib', [
    //                     ['name', [
    //                         ['surname'],
    //                         ['given-names']]],
    //                     ['email'],
    //                     ['xref']]]]],
    //             ['aff'],
    //             ['pub-date', [
    //                 ['year']]],
    //             ['elocation-id'],
    //             ['history', [
    //                 ['date', [
    //                     ['day'],
    //                     ['month'],
    //                     ['year']]]]],
    //             ['abstract', [
    //                 ['p']]]]]]],
    //     ['body',[
    //         ['p']]],
    //     ['back',[
    //         ['ack',
    //             ['p']]]],
    // ];

    $requiredAttribute = [

    ];
    
    $number = 0;
    ${'iteration-' . $number} = 0;
    $importedRoot = $doc->documentElement;
    foreach ($requiredElements as $key1 => $value1) {
        // 1st child
        if (gettype($value1) == 'array') {
            ${'iteration-' . ++$number} = 0;
            foreach ($value1 as $key2 => $value2) {
                // 2nd child
                $nextSibling = key($value1[++${'iteration-' . $number}]);
                
                if ($importedRoot->getElementsByTagName($key2)->item(0) == null) {
                    $importedRoot->getElementsByTagName($nextSibling)->item(0)->parentNode->insertBerfore(
                        $appendingElementName,
                        $importedRoot->getElementsByTagName($nextSibling)->item(0)
                    );
                    # code...
                }
                if (gettype($value2) == 'array') {
                    ${'iteration-' . ++$number} = 0;
                    foreach ($value2 as $key3 => $value3) {
                        // 3rd child
                        $nextSibling = key($value1[++${'iteration-' . $number}]);
                
                        if ($importedRoot->getElementsByTagName($key3)->item(0) == null) {
                            $importedRoot->getElementsByTagName($nextSibling)->item(0)->parentNode->insertBerfore(
                                $appendingElementName,
                                $importedRoot->getElementsByTagName($nextSibling)->item(0)
                            );
                            # code...
                        }
                        if (gettype($value3) == 'array') {
                            ${'iteration-' . ++$number} = 0;
                            foreach ($value3 as $key4 => $value4) {
                                // 4th child
                                $nextSibling = key($value1[++${'iteration-' . $number}]);

                                if ($importedRoot->getElementsByTagName($key4)->item(0) == null) {
                                    $importedRoot->getElementsByTagName($nextSibling)->item(0)->parentNode->insertBerfore(
                                        $appendingElementName,
                                        $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                    );
                                    # code...
                                }
                                if (gettype($value4) == 'array') {
                                    foreach ($value4 as $key5 => $value5) {
                                        // 5th child
                                        $nextSibling = key($value1[++${'iteration-' . $number}]);

                                        if ($importedRoot->getElementsByTagName($key5)->item(0) == null) {
                                            $importedRoot->getElementsByTagName($nextSibling)->item(0)->parentNode->insertBerfore(
                                                $appendingElementName,
                                                $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                            );
                                            # code...
                                        }
                                        if (gettype($value5) == 'array') {
                                            foreach ($value5 as $key6 => $value6) {
                                                // 6th child
                                                $nextSibling = key($value1[++${'iteration-' . $number}]);

                                                if ($importedRoot->getElementsByTagName($key6)->item(0) == null) {
                                                    $importedRoot->getElementsByTagName($nextSibling)->item(0)->parentNode->insertBerfore(
                                                        $appendingElementName,
                                                        $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                                    );
                                                    # code...
                                                }
                                                if (gettype($value6) == 'array') {
                                                    foreach ($value6 as $key7 => $value7) {
                                                        // 7th child
                                                        $nextSibling = key($value1[++${'iteration-' . $number}]);

                                                        if ($importedRoot->getElementsByTagName($key7)->item(0) == null) {
                                                            $importedRoot->getElementsByTagName($nextSibling)->item(0)->parentNode->insertBerfore(
                                                                $appendingElementName,
                                                                $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                                            );
                                                            # code...
                                                        }
                                                        if (gettype($value7) == 'array') {
                                                            
                                                        }
                                                    }
                                                    unset(${'iteration-' . $number});
                                                    ${'iteration-' . --$number};
                                                }
                                            }
                                            unset(${'iteration-' . $number});
                                            ${'iteration-' . --$number};
                                        }
                                    }
                                    unset(${'iteration-' . $number});
                                    ${'iteration-' . --$number};
                                }
                            }
                            unset(${'iteration-' . $number});
                            ${'iteration-' . --$number};
                        }
                    }
                    unset(${'iteration-' . $number});
                    ${'iteration-' . --$number};
                }
            }
            unset(${'iteration-' . $number});
            ${'iteration-' . --$number};
        }
    }

    // foreach ($requiredElements as $root) {
    //     // to secure $root so the foreach don't break
    //     $securedRoot = $root;
    //     // count if no more string
    //     $stop = 0;
    //     while (true) {
    //         if ($stop = 2) {
    //             $stop = 0;
    //             break;
    //         }
    //         if (gettype($securedRoot) == 'array') {
    //             foreach ($securedRoot as $child) {
    //                 $currentChildParent = $securedRoot;
    //                 $securedRoot = $child;
    //                 $stop = 0;
    //             }
    //         } else {
    //             $stop++;
    //         }
    //     }
    // }
?>