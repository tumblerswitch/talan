<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsersList extends Model
{
    //todo назвать по другому, без 'users', чтоб не было непонимания
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'users_list';

    /**
     * @var string[]
     */
    protected $fillable = [
        'fio',
        'email',
        'phone',
    ];
}
