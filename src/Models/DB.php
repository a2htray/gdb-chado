<?php

namespace A2htray\GDBChado\Models;

/**
 * Class DB
 * @property integer $db_id
 */
class DB extends ChadoBaseModel
{
    public $primaryKey = 'db_id';
    protected $table = 'db';
    protected $fillable = ['name', 'description'];

    public function a()
    {

    }
}
//* @property string $name
//* @property string $description
//* @property string $urlprefix
//* @property string $url
