<?php
        $requiredElements = [
            'article' => [
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
                            'day' => null,
                            'month' => null,
                            'year' => null
                        ],
                        'elocation-id' => null,
                        'history' => [
                            'date' => [
                                'day' => null,
                                'month' => null,
                                'year' => null
                            ]
                        ],
                        'abstract' => [
                            'p' => null
                        ]
                        
                    ],
                ],
                'body' => [
                    'p' => null
                ],
                'back' => [
                    'ack' => [
                        'p' => null
                    ]
                ]
            ]
        ];

        $number = 0;
        ${'iteration-' . $number} = 0;
        $importedRoot = $doc->documentElement;
        // parent
        foreach ($requiredElements as $key1 => $value1) {
            // 1st child
            if (gettype($value1) == 'array') {
                ${'iteration-' . ++$number} = 0;
                foreach ($value1 as $key2 => $value2) {
                    // 2nd child
                    $arrayKeys = array_keys($value1);
                    $count = count($arrayKeys) - 1;
                    if ($count != ${'iteration-' . $number}) {
                        $nextSibling = $arrayKeys[++${'iteration-' . $number}];
                    } else {
                        $nextSibling = $arrayKeys[${'iteration-' . $number}];
                    }

                    $currentIteration = ${'iteration-' . $number};
                    
                    if ($importedRoot->getElementsByTagName($key2)->item(0) == null) {
                        if ($importedRoot == null) {
                            $importedRoot->appendChild(
                                $doc->createElement($key2)
                            );
                        } else {
                            $importedRoot->insertBefore(
                                $doc->createElement($key2),
                                $importedRoot
                            );
                        }
                    }
                    if (gettype($value2) == 'array') {
                        ${'iteration-' . ++$number} = 0;
                        foreach ($value2 as $key3 => $value3) {
                            // 3rd child
                            $arrayKeys = array_keys($value2);
                            $count = count($arrayKeys) - 1;
                            if ($count != ${'iteration-' . $number}) {
                                $nextSibling = $arrayKeys[++${'iteration-' . $number}];
                            } else {
                                $nextSibling = $arrayKeys[${'iteration-' . $number}];
                            }

                            $currentIteration = ${'iteration-' . $number};
                    
                            if ($importedRoot->getElementsByTagName($key3)->item(0) == null) {
                                if ($importedRoot->getElementsByTagName($nextSibling)->item(0) == null) {
                                    while (true) {
                                        if ($currentIteration == $count) {
                                            break;
                                        }
                                        if ($importedRoot->getElementsByTagName($nextSibling)->item(0) != null) {
                                            # code...
                                            $importedRoot->getElementsByTagName($key2)->item(0)->insertBefore(
                                                $doc->createElement($key3),
                                                $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                            );
                                        }
                                        $nextSibling = $arrayKeys[++$currentIteration];
                                    }
                                    $importedRoot->getElementsByTagName($key2)->item(0)->appendChild(
                                        $doc->createElement($key3)
                                    );
                                } else {
                                    $importedRoot->getElementsByTagName($key2)->item(0)->insertBefore(
                                        $doc->createElement($key3),
                                        $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                    );
                                }
                            }
                            if (gettype($value3) == 'array') {
                                ${'iteration-' . ++$number} = 0;
                                foreach ($value3 as $key4 => $value4) {
                                    // 4th child
                                    $arrayKeys = array_keys($value3);
                                    $count = count($arrayKeys) - 1;
                                    if ($count != ${'iteration-' . $number}) {
                                        $nextSibling = $arrayKeys[++${'iteration-' . $number}];
                                    } else {
                                        $nextSibling = $arrayKeys[${'iteration-' . $number}];
                                    }

                                    $currentIteration = ${'iteration-' . $number};

                                    if ($importedRoot->getElementsByTagName($key4)->item(0) == null) {
                                        if ($importedRoot->getElementsByTagName($nextSibling)->item(0) == null) {
                                            while (true) {
                                                if ($currentIteration == $count) {
                                                    break;
                                                }
                                                if ($importedRoot->getElementsByTagName($nextSibling)->item(0) != null) {
                                                    # code...
                                                    $importedRoot->getElementsByTagName($key3)->item(0)->insertBefore(
                                                        $doc->createElement($key4),
                                                        $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                                    );
                                                }
                                                $nextSibling = $arrayKeys[++$currentIteration];
                                            }
                                            $importedRoot->getElementsByTagName($key3)->item(0)->appendChild(
                                                $doc->createElement($key4)
                                            );
                                        } else {
                                            $importedRoot->getElementsByTagName($key3)->item(0)->insertBefore(
                                                $doc->createElement($key4),
                                                $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                            );
                                        }
                                    }
                                    if (gettype($value4) == 'array') {
                                        ${'iteration-' . ++$number} = 0;
                                        foreach ($value4 as $key5 => $value5) {
                                            // 5th child
                                            $arrayKeys = array_keys($value4);
                                            $count = count($arrayKeys) - 1;
                                            if ($count != ${'iteration-' . $number}) {
                                                $nextSibling = $arrayKeys[++${'iteration-' . $number}];
                                            } else {
                                                $nextSibling = $arrayKeys[${'iteration-' . $number}];
                                            }

                                            $currentIteration = ${'iteration-' . $number};

                                            if ($importedRoot->getElementsByTagName($key5)->item(0) == null) {
                                                if ($importedRoot->getElementsByTagName($nextSibling)->item(0) == null) {
                                                    while (true) {
                                                        if ($currentIteration == $count) {
                                                            break;
                                                        }
                                                        if ($importedRoot->getElementsByTagName($nextSibling)->item(0) != null) {
                                                            # code...
                                                            $importedRoot->getElementsByTagName($key4)->item(0)->insertBefore(
                                                                $doc->createElement($key5),
                                                                $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                                            );
                                                        }
                                                        $nextSibling = $arrayKeys[++$currentIteration];
                                                    }
                                                    $importedRoot->getElementsByTagName($key4)->item(0)->appendChild(
                                                        $doc->createElement($key5)
                                                    );
                                                } else {
                                                    $importedRoot->getElementsByTagName($key4)->item(0)->insertBefore(
                                                        $doc->createElement($key5),
                                                        $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                                    );
                                                }
                                            }
                                            if (gettype($value5) == 'array') {
                                                ${'iteration-' . ++$number} = 0;
                                                foreach ($value5 as $key6 => $value6) {
                                                    // 6th child
                                                    $arrayKeys = array_keys($value5);
                                                    $count = count($arrayKeys) - 1;
                                                    if ($count != ${'iteration-' . $number}) {
                                                        $nextSibling = $arrayKeys[++${'iteration-' . $number}];
                                                    } else {
                                                        $nextSibling = $arrayKeys[${'iteration-' . $number}];
                                                    }

                                                    $currentIteration = ${'iteration-' . $number};

                                                    if ($importedRoot->getElementsByTagName($key6)->item(0) == null) {
                                                        if ($importedRoot->getElementsByTagName($nextSibling)->item(0) == null) {
                                                            while (true) {
                                                                if ($currentIteration == $count) {
                                                                    break;
                                                                }
                                                                if ($importedRoot->getElementsByTagName($nextSibling)->item(0) != null) {
                                                                    # code...
                                                                    $importedRoot->getElementsByTagName($key5)->item(0)->insertBefore(
                                                                        $doc->createElement($key6),
                                                                        $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                                                    );
                                                                }
                                                                $nextSibling = $arrayKeys[++$currentIteration];
                                                            }
                                                            $importedRoot->getElementsByTagName($key5)->item(0)->appendChild(
                                                                $doc->createElement($key6)
                                                            );
                                                        } else {
                                                            $importedRoot->getElementsByTagName($key5)->item(0)->insertBefore(
                                                                $doc->createElement($key6),
                                                                $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                                            );
                                                        }
                                                    }
                                                    if (gettype($value6) == 'array') {
                                                        ${'iteration-' . ++$number} = 0;
                                                        foreach ($value6 as $key7 => $value7) {
                                                            // 7th child
                                                            $arrayKeys = array_keys($value6);
                                                            $count = count($arrayKeys) - 1;
                                                            if ($count != ${'iteration-' . $number}) {
                                                                $nextSibling = $arrayKeys[++${'iteration-' . $number}];
                                                            } else {
                                                                $nextSibling = $arrayKeys[${'iteration-' . $number}];
                                                            }

                                                            $currentIteration = ${'iteration-' . $number};

                                                            if ($importedRoot->getElementsByTagName($key7)->item(0) == null) {
                                                                if ($importedRoot->getElementsByTagName($nextSibling)->item(0) == null) {
                                                                    while (true) {
                                                                        if ($currentIteration == $count) {
                                                                            break;
                                                                        }
                                                                        if ($importedRoot->getElementsByTagName($nextSibling)->item(0) != null) {
                                                                            # code...
                                                                            $importedRoot->getElementsByTagName($key6)->item(0)->insertBefore(
                                                                                $doc->createElement($key7),
                                                                                $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                                                            );
                                                                        }
                                                                        $nextSibling = $arrayKeys[++$currentIteration];
                                                                    }
                                                                    $importedRoot->getElementsByTagName($key6)->item(0)->appendChild(
                                                                        $doc->createElement($key7)
                                                                    );
                                                                } else {
                                                                    $importedRoot->getElementsByTagName($key6)->item(0)->insertBefore(
                                                                        $doc->createElement($key7),
                                                                        $importedRoot->getElementsByTagName($nextSibling)->item(0)
                                                                    );
                                                                }
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
?>