<?php

namespace App;

use App\Traits\Statable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Statable;
    const HISTORY_MODEL = [
        'name' => 'App\OrderState' // the related model to store the history
    ];
    const SM_CONFIG = 'order'; // the SM graph to use
}
