<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ToolGroup extends Model
{
    /**
     * @return HasMany
     */
    public function tools()
    {
        return $this->hasMany(Tool::class, 'tool_group_id');
    }
}
