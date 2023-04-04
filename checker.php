<?php
    $elements = [
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
    $requiredElements = [
        ['front',[
            ['journal-meta', [
                ['journal-id'],
                ['journal-title-group', [
                    ['journal-title']]],
                ['issn'],
                ['publisher', [
                    ['publisher-name']]]]],
            ['article-meta', [
                ['article-categories', [
                    ['subj-group', [
                        ['subject']]]]],
                ['title-group', [
                    ['article-title']]],
                ['contrib-group', [
                    ['contrib', [
                        ['name', [
                            ['surname'],
                            ['given-names']]],
                        ['email'],
                        ['xref']]]]],
                ['aff'],
                ['pub-date', [
                    ['year']]],
                ['elocation-id'],
                ['history', [
                    ['date', [
                        ['day'],
                        ['month'],
                        ['year']]]]],
                ['abstract', [
                    ['p']]]]]]],
        ['body',[
            ['p']]],
        ['back',[
            ['ack',
                ['p']]]],
    ];

    $requiredAttribute = [

    ];
    
    $index = 0;
    $indexName = 'element';
    $indexIncrement = 0;
    while (true) {
        ${$indexName . $indexIncrement} = $elements[$arrayKeys[$index]];
        
        $arrayKeys = array_keys(${$indexName . $indexIncrement});
        $elementIndex = count(${$indexName . $indexIncrement});
        $elementIndex--;


        var_dump($arrayKeys);
        while ($index != $elementIndex) {
            ${$indexName . $indexIncrement}[$arrayKeys[$index]];
            if (gettype(${$indexName . $indexIncrement}[$arrayKeys[$index]]) == 'array') {
                $indexIncrement++;
                ${$indexName . $indexIncrement};
            }
            $index++;
        }
        ${$indexName . $indexIncrement}--;
        break;

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