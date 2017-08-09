<?php

namespace Evans\Models;

use Evans\Models\Traits\IsEntity;
use Evans\Models\Traits\IsAuditable;

abstract class Entity
{
    use IsEntity;
    use IsAuditable;
}
