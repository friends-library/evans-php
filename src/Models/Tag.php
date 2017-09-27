<?php

namespace Evans\Models;

use Evans\Models\Traits\HasName;
use Evans\Models\Traits\HasDocument;

class Tag extends Entity
{
    use HasName;
    use HasDocument;

    /**
     * @var string
     */
    const LETTERS = '98752cd9-70cf-4341-a6bc-af4044637798';

    /**
     * @var string
     */
    const JOURNAL = '2b168edc-5e32-4717-b932-1c3a6def10c7';

    /**
     * @var string
     */
    const EXHORTATION = 'c361ffd5-9a95-4ec3-8671-07e2247a895a';

    /**
     * @var string
     */
    const DOCTRINAL = '98378da4-0a44-4121-94d7-10245589eb5e';

    /**
     * @var string
     */
    const DEVOTIONAL = '67511d52-27a2-423a-9eab-892e412a9510';

    /**
     * @var string
     */
    const BIOGRAPHY = 'c60064df-c666-45db-88b4-df35f4e858f0';

    /**
     * @var string
     */
    const HISTORY = '61871653-068a-4625-8ae8-fe680738f989';

    /**
     * @var string
     */
    const TREATISE = '38a9ff9c-0e0f-441b-93ca-a8aae91ad882';

    /**
     * @var string
     */
    const COMPILATION = '02035a57-623c-4017-a4dd-143b78073f67';
}
