<?php

namespace App\Trait;

trait QueryTrait
{
    public function queryByUserId($query)
    {
        $query->where('user_id', Auth()->id());
    }
}
