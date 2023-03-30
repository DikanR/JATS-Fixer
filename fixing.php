<?php
    // must use PHP 8

    function importFile($file){
        $doc = new DOMDocument();
        $doc->formatOutput = true;
        $doc->preserveWhiteSpace = false;
        $doc->load($file);

        return $doc;
    }

    $imported = importFile('contoh jats.xml');
    $importedRoot = $imported->documentElement;
    
    // Add or change things // ---------------------------------------------------------------- //
    
    // Create elements
    $articleCategories = $imported->createElement('article-categories');
    $journalMeta = $imported->createElement('journal-meta');
    $journalId = $imported->createElement('journal-id');
    $journalTitleGroup = $imported->createElement('journal-title-group');
    $issn = $imported->createElement('issn');
    $publisher = $imported->createElement('publisher');
    $publisherName = $imported->createElement('publisher-name');
    $subjGroup = $imported->createElement('subj-group');
    $subject = $imported->createElement('subject');
    $journalTitle = $imported->createElement('journal-title');
    $eLocationId = $imported->createElement('elocation-id');
    $pubDate = $imported->createElement('pub-date');
    $year = $imported->createElement('year');
    $ack = $imported->createElement('ack');
    
    // Append to element
    $importedRoot->getElementsByTagName('article-meta')->item(0)->insertBefore(
        $articleCategories,
        $importedRoot->getElementsByTagName('article-meta')->item(0)->firstChild);
    $importedRoot->getElementsByTagName('article-meta')->item(0)->insertBefore(
        $eLocationId,
        $importedRoot->getElementsByTagName('history')->item(0));
    $importedRoot->getElementsByTagName('article-meta')->item(0)->insertBefore(
        $pubDate,
        $importedRoot->getElementsByTagName('elocation-id')->item(0));
    $importedRoot->getElementsByTagName('front')->item(0)->insertBefore(
        $journalMeta,
        $importedRoot->getElementsByTagName('front')->item(0)->firstChild);
    $importedRoot->getElementsByTagName('journal-meta')->item(0)->appendChild($journalId);
    $importedRoot->getElementsByTagName('journal-meta')->item(0)->appendChild($journalTitleGroup);
    $importedRoot->getElementsByTagName('journal-meta')->item(0)->appendChild($issn);
    $importedRoot->getElementsByTagName('journal-meta')->item(0)->appendChild($publisher);
    $importedRoot->getElementsByTagName('publisher')->item(0)->appendChild($publisherName);
    $importedRoot->getElementsByTagName('article-categories')->item(0)->appendChild($subjGroup);
    $importedRoot->getElementsByTagName('subj-group')->item(0)->appendChild($subject);
    $importedRoot->getElementsByTagName('journal-title-group')->item(0)->appendChild($journalTitle);
    $importedRoot->getElementsByTagName('pub-date')->item(0)->appendChild($year);
    $importedRoot->getElementsByTagName('abstract')->item(0)->appendChild($imported->createElement('p'));
    $importedRoot->getElementsByTagName('back')->item(0)->appendChild($ack);
    $importedRoot->getElementsByTagName('ack')->item(0)->appendChild($imported->createElement('p'));
    
    // Append node value
    $importedRoot->getElementsByTagName('journal-id')->item(0)->nodeValue = 'Journal ID';
    $importedRoot->getElementsByTagName('issn')->item(0)->nodeValue = '0000-0000';
    $importedRoot->getElementsByTagName('publisher-name')->item(0)->nodeValue = 'Nama publisher';
    $importedRoot->getElementsByTagName('journal-title')->item(0)->nodeValue = 'Judul journal';
    $importedRoot->getElementsByTagName('article-title')->item(0)->nodeValue = 'Judul artikel';
    $importedRoot->getElementsByTagName('subject')->item(0)->nodeValue = 'Subject';
    $importedRoot->getElementsByTagName('elocation-id')->item(0)->nodeValue = 'A00';
    $importedRoot->getElementsByTagName('year')->item(0)->nodeValue = '2023';
    $importedRoot->getElementsByTagName('abstract')->item(0)->getElementsByTagName('p')->item(0)->nodeValue = '(Anything to add here)';
    $importedRoot->getElementsByTagName('ack')->item(0)->getElementsByTagName('p')->item(0)->nodeValue = '(Anything to add here)';
    
    // Add node value to every empty <p> elements with id attribute
    foreach ($importedRoot->getElementsByTagName('p') as $pElement) {
        // var_dump($pElement->nodeValue);
        if ($pElement->hasAttribute('id') && $pElement->nodeValue == '') {
            $pElement->nodeValue = '(Anything to add here)';
        }
    }
    
    // Set attribute
    $importedRoot->setAttribute('article-type', 'addendum');
    $importedRoot->getElementsByTagName('journal-id')->item(0)->setAttribute('journal-id-type', 'pmc');
    $importedRoot->getElementsByTagName('subj-group')->item(0)->setAttribute('subj-group-type', 'heading');
    $importedRoot->getElementsByTagName('issn')->item(0)->setAttribute('pub-type', 'epub');
    $importedRoot->getElementsByTagName('pub-date')->item(0)->setAttribute('publication-format', 'electronic');
    $importedRoot->getElementsByTagName('pub-date')->item(0)->setAttribute('date-type', 'pub');

    // Fix ali schemas typo
    $importedRoot->setAttributeNS(
        'http://www.w3.org/2000/xmlns/',
        'xmlns:ali',
        'http://www.niso.org/schemas/ali/1.0/'
    );

    // Change contrib-type attribute to author
    foreach ($importedRoot->getElementsByTagName('contrib') as $contribTag) {
        // Check if current element had the corresponding attribute
        if ($contribTag->hasAttribute('contrib-type')) {
            $contribTag->setAttribute('contrib-type', 'author');
        }
    }

    // Remove every tag formatted in <title> elements
    foreach ($importedRoot->getElementsByTagName('title') as $titleTag) {
        // Check if current element had the corresponding attribute
        if ($titleTag->firstChild->hasAttribute('id') && str_contains($titleTag->firstChild->getAttribute('id'), '_')) {
            $titleTag->nodeValue = $titleTag->firstChild->nodeValue;
        }
    }

    $increment = 0;

    // Duplication on sup elements fix
    foreach ($importedRoot->getElementsByTagName('sup') as $supTag) {
        // Fix duplicated on "_superscript-{numbers}"
        // Check if the index is valid "_superscript-{numbers}" for replacement
        if (str_contains($supTag->getAttribute('id'), '_')) {
            $stripPosition = strpos($supTag->getAttribute('id'), '-');
            $intPosition = $stripPosition + 1;
    
            $string = substr($supTag->getAttribute('id'), 0, $stripPosition);
            $increment++;
    
            $setAttribute = "{$string}-{$increment}";
    
            $supTag->setAttribute('id', $setAttribute);
        }
    }

    // End of add or change things //--------------------------------------------------------- //

    // Update dtd to 1.3
    $imp = new DOMImplementation;
    $dtd = $imp->createDocumentType(
        'article',
        '-//NLM//DTD JATS (Z39.96) Journal Publishing DTD with MathML3 v1.3 20210610//EN',
        'JATS-journalpublishing1-3-mathml3.dtd'
    );
    $xmlNew = $imp->createDocument("", "", $dtd);
    $xmlNew->encoding = 'UTF-8';
    $node = $xmlNew->importNode($importedRoot, true);
    $xmlNew->appendChild($node);
    $savedName = 'modified.xml';

    $xmlNew->save($savedName);

    // No Break line fixes
    $imported = importFile($savedName);
    $imported->save($savedName);

    echo "Saved as \"{$savedName}\"\n";

?>