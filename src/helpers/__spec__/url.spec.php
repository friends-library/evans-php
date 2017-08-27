<?php

use Evans\Models\Document;
use Evans\Models\Friend;
use Evans\Models\Format;
use Evans\Models\Edition;

require_once __DIR__ . '/../index.php';

describe('url()', function () {

    beforeEach(function () {
        $this->friend = new Friend();
        $this->friend->setSlug('rebecca-jones');
        $this->document = new Document();
        $this->document->setTitle('The Diary');
        $this->document->setSlug('diary');
        $this->edition = new Edition();
        $this->edition->setType('updated');
        $this->format = new Format();
        $this->format->setType('audio');
        $this->format->setEdition($this->edition);
        $this->edition->setDocument($this->document);
        $this->document->setFriend($this->friend);
    });

    it('returns special audio url for audio format entity', function () {
        $url = url($this->format);

        expect($url)->to->equal('/rebecca-jones/diary/updated/audio');
    });

    it('returns special softcover url for softcover format entity', function () {
        $this->format->setType('softcover');

        $url = url($this->format);

        expect($url)->to->equal('/rebecca-jones/diary/updated/softcover');
    });

    it('returns a download link for a downloadable asset', function () {
        $this->format->setType('pdf');

        $url = url($this->format);

        expect($url)->to->equal('/download/rebecca-jones/diary/updated/pdf');
    });
});
