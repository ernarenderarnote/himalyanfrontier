<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Profile extends Model
{
	use SoftDeletes;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'user_id',
        'age',
		'gender',
		'height',
		'weight',
		'address',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];
	
    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}