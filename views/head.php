<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Friends Library</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" media="all" rel="stylesheet">
        <link href="/css/vendor.css" media="all" rel="stylesheet" />
        <link href="/css/app.css" media="all" rel="stylesheet" />
        <script src="/js/app.js" defer></script>
    </head>
    <body>
        <nav id="menu" class="slideout-menu">
            <h2>Friends</h2>
            <ul>
            <?php

            $friends = [
                'Rebecca Jones' => 'rebecca-jones',
                'Isaac Penington' => 'isaac-penington',
                'Robert Barclay' => 'robert-barclay',
                'John Gratton' => 'john-gratton',
                'John Burnyeat' => 'john-burnyeat',
                'Stephen Crisp' => 'stephen-crisp',
                'Catherine Phillips' => 'catherine-payton-phillips',
                'John Griffeth' => 'john-griffeth',
                'Thomas Story' => 'thomas-story',
            ];

            foreach ($friends as $name => $slug) {
                ?><li><a href="/friend/<?= $slug ?>"><?= $name ?></a></li><?php
            }
            ?>
            </ul>
        </nav>

        <main id="site" class="slideout-panel">
            <div class="block container-fluid nav-block">
                <div class="row">
                    <div class="col">
                        <a id="mobile-toggle" class="mobile-toggle">☰</a>
                        <p>
                            <a href="/" class="logo">
                                Friends Library
                            </a>
                        </p>
                    </div>
                </div>
            </div>
