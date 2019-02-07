<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Authorize extends Model
{
    protected $table = 'authorizes';
    public $timestamps = true;
    protected $dates = ['authorized_at', 'deleted_at'];
    protected $fillable = [
        'user_id', 'authorized', 'token', 'ip_address', 'browser', 'os', 'location', 'attempt', 'authorized_at',
    ];
    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', Auth::id());
    }
    public function setAuthorizedAtAttribute($date)
    {
        $this->attributes['authorized_at'] = Carbon::parse($date);
    }
    public static function active()
    {
        return with(new self)
            ->where('ip_address', Request::ip())
            ->where('authorized', true)
            ->where('authorized_at', '<', Carbon::tomorrow())
            ->first();
    }
    public function resetAttempt()
    {
        $this->update(['attempt' => 0]);

        return $this;
    }
    public function noAttempt()
    {
        return $this->attempt < 1;
    }
    public static function make()
    {
        return self::firstOrCreate([
            'ip_address' => Request::ip(),
            'authorized' => false,
            'user_id' => Auth::id(),
        ]);
    }
    public static function inactive()
    {
        $query = self::active();

        return $query ? null : true;
    }
}
