<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class live_stream_model extends Model
{
    //
    use Notifiable;
    use SoftDeletes;

    protected $table = 'live_streams_tb';
    public $incrementing = false;
    protected $primaryKey = 'unique_id';
    protected $keyType = 'unique_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
            // $table->dropColumn(['description', 'passcode', 'privacy', 'software']);
    protected $fillable = ['unique_id', 'user_id','title', 'status', 'meeting_url', 'date_to_start', 'time_to_start', 'description', 'passcode', 'privacy', 'software'];


    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function get_all($condition, $id = 'id'){

        $course = live_stream_model::where($condition)->orderBy($id,'desc')->get();

        return $course;

    }

}
