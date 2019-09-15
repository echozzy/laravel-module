<?php

namespace Zzy\Module\Models;


use Illuminate\Database\Eloquent\Model;


class AdminMenu extends Model
{

    protected $guarded = ['id'];


    public function __construct(array $attributes = [])
    {
        $attributes['p_id'] = $attributes['p_id'] ?? 0;

        parent::__construct($attributes);
    }

    public static function create(array $attributes = [])
    {
        return static::query()->create($attributes);
    }

}
