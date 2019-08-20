<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * @property array|Request|string name
 * @property array|Request|string tool_group_id
 * @property mixed user_id
 * @property array|Request|string cost_price
 * @property \DateTime purchase_date
 */
class Tool extends Model
{
    /**
     * @return BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(ToolGroup::class, 'tool_group_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
