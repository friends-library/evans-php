<?php

$app->get(
    '/friend/{slug}',
    'FriendController@slug'
);

$app->get(
    '/{friend_slug}/{document_slug}',
    'DocumentController@get'
);

$app->get(
    '/download/{friend_slug}/{doc_slug}/{edition_type}/{format_type}[/{chapter}]',
    'DownloadController@logAndRedirect'
);

$app->get('/not-found', function () {
    echo '¯\_(ツ)_/¯';
});
