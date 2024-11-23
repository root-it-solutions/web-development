<?php

namespace v1\Models;

use Illuminate\Database\Eloquent\Model;

class MasternodeList extends Model
{
    protected $primaryKey = 'id'; // or null
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'ownerAuthAddress', 'operatorAuthAddress', 'creationHeight', 'resignHeight' ,'state', 'mintedBlocks',
        'targetMultiplier1', 'targetMultiplier2', 'targetMultiplier3', 'targetMultiplier4', 'timelock'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
