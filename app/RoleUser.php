<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class RoleUser extends Authenticatable
{
	protected $table = 'role_user';
}
