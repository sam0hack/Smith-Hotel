<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Room extends Model
    {


        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['category_id', 'room_number', 'cost', 'number_of_beds', 'title', 'description'];


    }
