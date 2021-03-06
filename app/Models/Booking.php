<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;


    class Booking extends Model
    {


        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['room_id', 'user_id', 'start_date', 'end_date'];

    }
