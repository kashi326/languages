<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserVoteDiscussion extends Model
{    use SoftDeletes;

    protected $table = 'user_vote_discussion';
}
