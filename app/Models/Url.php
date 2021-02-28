<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Classes\CodeGenerator;
class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'url',
        'expiration',
        'user_id'
    ];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function short_url($long_url){
        $url = self::create([
            'url'=>$long_url,
            'user_id'=> auth()->user()->id
        ]);

        $code = (new CodeGenerator())->get_code($url->id);

        $url->code = $code;
        $url->save();
        return $url->code;
    }
}
