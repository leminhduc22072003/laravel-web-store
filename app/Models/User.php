<?php
namespace App\Models;

class User extends AppModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','email','username','name','password','avatar','auth_token' ,'last_action' ,'extra_token', 'group', 'active','gender', 'phone'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password','auth_token','extra_token', 'last_action'
    ];


    /**
     * Only use this for specific purpose
     *
     */
    public function getAuthToken()
    {
        return $this->auth_token;
    }

    public $files =
    [
        'avatar'=>
        [
            'ext'=>'jpg|jpeg|png',
            'size'=>'5120',
            'multiple'=>false
        ]
    ];

}
