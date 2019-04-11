<?php

namespace A2htray\GDBChado\Models;

class MaterializedView extends ChadoBaseModel
{
    public $primaryKey = 'materialized_view_id';
    protected $table = 'materialized_view';
}