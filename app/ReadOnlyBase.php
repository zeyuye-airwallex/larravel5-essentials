<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyBase
{
    // ReadOnlyBase
    protected $titles_array = [];

    public function all()
    {
        return $this->titles_array;
    }

    public function get($id)
    {
        return $this->titles_array[$id];
    }
}
