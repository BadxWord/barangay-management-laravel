<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Officials extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function positions(){
        return $this->belongsToMany(Positions::class)->withTimestamps();
    }

    public function position(){
        return $this->belongsTo(Positions::class);
    }

    public function barangay(){
        return $this->belongsTo(Barangays::class, 'barangay_id', 'id');
    }

    public function projects(){
        return $this->belongsToMany(Projects::class);
    }

    // tried added a db query for retrieving residentsFiles' file name
    public function hasResidentsFile(){
        return DB::table('officials')
    ->join('barangays', 'officials.barangay_id', '=', 'barangays.id')
    ->join('residents', 'barangays.id', '=', 'residents.barangay_id')
    ->join('residents_files', 'residents.id', '=', 'residents_files.resident_id')
    ->join('files', 'residents_files.file_id', '=', 'files.id')
    ->join('users', 'residents_files.user_id', '=', 'users.id')
    ->where('officials.id', $this->id)
    ->select(
        'residents_files.*',
        'files.name as file_name',
        'users.name as user_name'
    )
    ->get();
    }
}
