<?php
    $requiredElement = [
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
        
    ]
?>