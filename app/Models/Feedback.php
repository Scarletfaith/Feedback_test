<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int                     $id
 * @property      string                  $title
 * @property      string                  $description
 * @property      object                  $file
 * @property      int                     $user_id
 * @property      CarbonInterface         $created_at
 * @property      CarbonInterface|null    $updated_at
 * @property      CarbonInterface|null    $reply_at
 */
class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';
    protected $fillable = ['title', 'description', 'file', 'user_id'];
    protected $quarded = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
