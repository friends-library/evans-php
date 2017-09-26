<?php

use Evans\Models\Document;
use Evans\Models\Friend;

describe('responsive_document_title()', function () {

    beforeEach(function () {
        $this->document = new Document();
        $this->friend = new Friend();
        $this->friend->setName('Job Scott');
        $this->document->setFriend($this->friend);
    });

    it('wraps leading "The"', function () {
        $this->document->setTitle('The Life and Letters of a Wilburite Quaker');

        $result = responsive_document_title($this->document);

        $expected = '<span class="d-none d-sm-inline">The </span>Life and Letters of a Wilburite Quaker';
        expect($result)->to->equal($expected);
    });

    it('wraps "of {FriendName}"', function () {
        $this->document->setTitle('Unabridged, Unedited, Uncut Journal of Job Scott');

        $result = responsive_document_title($this->document);

        $expected ='Unabridged, Unedited, Uncut Journal<span class="d-none d-sm-inline"> of Job Scott</span>';
        expect($result)->to->equal($expected);
    });

    it('removes maiden names', function () {
        $this->friend->setName('Catherine (Payton) Phillips');
        $this->document->setTitle('Life and Correspondence of Catherine Phillips');

        $result = responsive_document_title($this->document);

        $expected ='Life and Correspondence<span class="d-none d-sm-inline"> of Catherine Phillips</span>';
        expect($result)->to->equal($expected);
    });

    it('removes possessive forms of name', function () {
        $this->friend->setName('Thomas Story');
        $this->document->setTitle('Thomas Story\'s Early Years & Spiritual Growth');

        $result = responsive_document_title($this->document);

        $expected ='<span class="d-none d-sm-inline">Thomas Story\'s </span>Early Years & Spiritual Growth';
        expect($result)->to->equal($expected);
    });

    it('does not alter titles shorter than 35 characters', function () {
        $this->friend->setName('Thomas Story');
        $this->document->setTitle('Thomas Story\'s Journal');

        $result = responsive_document_title($this->document);

        expect($result)->to->equal("Thomas Story's Journal");
    });

    it('only removes leading "The " if that gets it under 35 characters', function () {
        $this->friend->setName('Thomas Story');
        $this->document->setTitle('The LOLOLOLOLOLOLOLOL of Thomas Story');

        $result = responsive_document_title($this->document);

        $expected ='<span class="d-none d-sm-inline">The </span>LOLOLOLOLOLOLOLOL of Thomas Story';
        expect($result)->to->equal($expected);
    });
});
