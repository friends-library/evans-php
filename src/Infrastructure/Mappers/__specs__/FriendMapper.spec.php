<?php

use Cake\Chronos\Chronos;
use Evans\Models\Friend;
use Evans\Models\Chapter;
use Evans\Models\Document;
use Evans\Models\Edition;
use Evans\Models\Format;
use Evans\Infrastructure\Mappers\FriendMapper;
use Evans\Infrastructure\Mappers\DocumentMapper;
use Evans\Infrastructure\Mappers\ChapterMapper;
use Evans\Infrastructure\Mappers\EditionMapper;
use Evans\Infrastructure\Mappers\FormatMapper;

$fixture = __DIR__ . '/friend.fixture.json';
$data = json_decode(file_get_contents($fixture), true);

describe('FriendMapper->map()', function () use ($data) {

    beforeEach(function () use ($data) {
        $this->data = $data;
        $this->mapper = new FriendMapper(
            new DocumentMapper(
                new ChapterMapper(),
                new EditionMapper(new FormatMapper())
            )
        );
    });

    describe('the root Friend model', function () {
        beforeEach(function () {
            $this->friend = $this->mapper->map($this->data);
        });

        it('is a Friend', function () {
            expect($this->friend)->to->be->an->instanceof(Friend::class);
        });

        it('has the correct id', function () {
            expect($this->friend->getId())->to->equal('friend-id-r-jones');
        });

        it('has timestamps', function () {
            $created = $this->friend->getCreatedAt();
            $updated = $this->friend->getUpdatedAt();
            expect($created)->to->be->an->instanceof(Chronos::class);
            expect($updated)->to->be->an->instanceof(Chronos::class);
        });

        it('has description', function () {
            expect($this->friend->getDescription())->to->equal('friend desc');
        });

        it('has name', function () {
            expect($this->friend->getName())->to->equal('Rebecca Jones');
        });

        it('has slug', function () {
            expect($this->friend->getSlug())->to->equal('rebecca-jones');
        });
    });

    describe('the mapped documents', function () {
        beforeEach(function () {
            $this->friend = $this->mapper->map($this->data);
            $this->docs = $this->friend->getDocuments();
            $this->doc = $this->docs[0];
        });

        it('are correct in number', function () {
            expect(count($this->docs))->to->equal(1);
            expect($this->doc)->to->be->an->instanceof(Document::class);
        });

        it('have the correct id', function () {
            expect($this->doc->getId())->to->equal('doc-id-r-jones-journal');
        });

        it('have timestamps', function () {
            $created = $this->doc->getCreatedAt();
            $updated = $this->doc->getUpdatedAt();
            expect($created)->to->be->an->instanceof(Chronos::class);
            expect($updated)->to->be->an->instanceof(Chronos::class);
        });

        it('have a reference to the Friend', function () {
            expect($this->doc->getFriend())->to->equal($this->friend);
        });
    });

    describe('the mapped document chapters', function () {
        beforeEach(function () {
            $this->friend = $this->mapper->map($this->data);
            $this->doc = $this->friend->getDocuments()[0];
            $this->chapters = $this->doc->getChapters();
        });

        it('are correct in number', function () {
            expect(count($this->chapters))->to->equal(2);
            expect($this->chapters[0])->to->be->an->instanceof(Chapter::class);
            expect($this->chapters[1])->to->be->an->instanceof(Chapter::class);
        });

        it('have the correct id', function () {
            expect($this->chapters[0]->getId())->to->equal('chapter-id-1');
            expect($this->chapters[1]->getId())->to->equal('chapter-id-2');
        });

        it('have correct orders', function () {
            expect($this->chapters[0]->getOrder())->to->equal(1);
            expect($this->chapters[1]->getOrder())->to->equal(2);
        });

        it('have a reference to the document', function () {
            expect($this->chapters[0]->getDocument())->to->equal($this->doc);
        });
    });

    describe('the mapped document editions', function () {
        beforeEach(function () {
            $friend = $this->mapper->map($this->data);
            $this->doc = $this->friend->getDocuments()[0];
            $this->editions = $this->doc->getEditions();
        });

        it('are correct in number', function () {
            expect(count($this->editions))->to->equal(2);
            expect($this->editions[0])->to->be->an->instanceof(Edition::class);
            expect($this->editions[1])->to->be->an->instanceof(Edition::class);
        });

        it('have the correct id', function () {
            expect($this->editions[0]->getId())->to->equal('edition-id-updated');
            expect($this->editions[1]->getId())->to->equal('edition-id-original');
        });

        it('have a reference to the document', function () {
            expect($this->editions[0]->getDocument())->to->equal($this->doc);
            expect($this->editions[1]->getDocument())->to->equal($this->doc);
        });

        it('have correct types', function () {
            expect($this->editions[0]->getType())->to->equal('updated');
            expect($this->editions[1]->getType())->to->equal('original');
        });
    });

    describe('the mapped document edition formats', function () {
        beforeEach(function () {
            $friend = $this->mapper->map($this->data);
            $doc = $friend->getDocuments()[0];
            $this->editions = $doc->getEditions();
            $this->updatedFormats = $this->editions[0]->getFormats();
            $this->originalFormats = $this->editions[1]->getFormats();
        });

        it('are correct in number', function () {
            expect(count($this->updatedFormats))->to->equal(1);
            expect($this->updatedFormats[0])->to->be->an->instanceof(Format::class);
            expect(count($this->originalFormats))->to->equal(2);
            expect($this->originalFormats[0])->to->be->an->instanceof(Format::class);
            expect($this->originalFormats[1])->to->be->an->instanceof(Format::class);
        });

        it('have correct types', function () {
            expect($this->updatedFormats[0]->getType())->to->equal('pdf');
            expect($this->originalFormats[0]->getType())->to->equal('mobi');
            expect($this->originalFormats[1]->getType())->to->equal('pdf');
        });

        it('have a reference to the edition', function () {
            expect($this->updatedFormats[0]->getEdition())->to->equal($this->editions[0]);
            expect($this->originalFormats[0]->getEdition())->to->equal($this->editions[1]);
            expect($this->originalFormats[1]->getEdition())->to->equal($this->editions[1]);
        });
    });
});
