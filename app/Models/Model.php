<?php
namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel
{
    public $incrementing = false;
    public $timestamps = true;

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = static::generateUuid();
        });
    }

    /**
     * 生成 32 个字符的 UUID
     * @return string
     */
    static public function generateUuid()
    {
        return str_replace("-", "", Uuid::generate()->string);
    }

}
