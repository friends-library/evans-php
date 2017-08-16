<?php

$app->get('/friend/{slug}', 'FriendController@slug');

$app->get('/{friend_slug}/{document_slug}', 'DocumentController@get');

$app->get('/not-found', function () {
    echo '¯\_(ツ)_/¯';
});
