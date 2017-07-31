<?php

namespace Evans\Models;

use Evans\Models\Traits\IsEntity;
use Evans\Models\Traits\IsAuditable;
use Evans\Models\Traits\HasSlug;
use Evans\Models\Traits\HasName;
use Evans\Models\Traits\HasDescription;

class Friend
{
    use IsEntity;
    use HasName;
    use HasSlug;
    use HasDescription;
    use IsAuditable;
}
