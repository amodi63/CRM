<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable =  ['first_name', 'last_name', 'job_title', 'email',  'phone_no', 'birthday', 'avatar', 'country', 'city','created_by'];
    protected static function booted(): void {

    
    static::addGlobalScope(new UserScope);

    static::creating(function (Contact $classroom) {
    
        $classroom->created_by = auth()->id() ;
    
    });


}

public static function gender_types(): array
    {
        return [
            'male' => 'Male',
            'female' => 'Female',
        ];
    }
public function user()
{
     return $this->belongsTo(User::class, 'user_id', 'id');
}
public function getAvatarUrlAttribute()
{
    if (!$this->avatar) {
        if ($this->gender == 'female') {
            return asset('/media/default-female-avatar.png');
        }
        return asset('/media/default-male-avatar.png');
    }

    return asset('storage/' . $this->attributes['avatar']);
}


public function getfullNameAttribute(){
    return $this->first_name . ' '. $this->last_name;
}

public static function filterAndFormatPhoneNumbers(?array $phoneNumbers)
{
    if ($phoneNumbers && is_array($phoneNumbers)) {
        $filteredPhoneNumbers = array_filter($phoneNumbers, function ($value) {
            return $value !== null;
        });
        return implode(',', $filteredPhoneNumbers);
    }

    return null;
}
}
