<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueList extends BaseModel
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'listof_issue_office';
}
