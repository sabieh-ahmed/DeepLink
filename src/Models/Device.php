<?php

namespace DeepLink\Common\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Devices table
     * @var string
     */
    protected $table = 'devices';

    /**
     * Device token
     * @var array
     */
    protected $fillable = ['user_id','device_token'];

    /**
     * Device belongs to specific user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('deeplink.user_class'));
    }

}
