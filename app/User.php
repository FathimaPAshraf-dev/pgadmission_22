<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
//use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
//            LogsActivity;   

    /**
     * The attributes that are mass assignable.
     *
     * @var array  
     */  
    
    public $timestamps = false;
    protected $table='tb_pgapp';
    protected $primaryKey = 'pgapp_sl';
     protected $guarded = [ 
        		'pgapp_sl'			
    ];
//    protected $guarded = [ 
//        
//    ];
 protected static $logAttributes = ['pgapp_name', 'pgapp_id'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'super_pwd', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected $dates=[
        'current_sign_in_at', 'last_sign_in_at'
    ];
//    public function getAuthPassword() {
// //       return $this->super_pwd;
//        return $this->postpgapp_app_password;
//     }
 
    public function getEmailForPasswordReset()
    {
        return $this->pgapp_email;
    }

    
    public function subcaste_table()
    {
        return $this->belongsTo('App\ReservationList', 'pgapp_caste_sl','id');
    }
    public function religion_table()
    {
        return $this->belongsTo('App\Religion', 'stud_religion_sl','relgn_sl');
    }
  
     public function income_table()
    {
        return $this->belongsTo('App\Income', 'stud_income_sl','inc_sl');
    }
    public  function admnscheme_table()
    {
    	return $this->belongsTo('App\AdmissionScheme', 'pgapp_adsc_sl','adsc_sl');
    }
    public  function readmnscheme_table()
    {
    	return $this->belongsTo('App\AdmissionScheme', 'stud_quota','adsc_sl');
    }
     public  function centre_table()
    {
    	return $this->belongsTo('App\Centre', 'stud_centre_sl','centre_sl');
    }
     public  function changecentre_table()
    {
    	return $this->belongsTo('App\Centre', 'exam_district','centre_sl');
    }
    
    public function series(){
        
        		return $this->belongsTo('App\Series', 'series_id');

    }
//       public static function boot(){
//         parent::boot();
//             static::creating(function($model){
//                $model->number=User::where('series_id',5)->max('number')+1;
//                $model->pgapp_id = $model->series->prefix.str_pad($model->number,5,0,STR_PAD_LEFT);

// //                $model->number=User::max('number')+1;
// //                $model->pgapp_id="ADMPG22".str_pad($model->number,5,0,STR_PAD_LEFT);
//             });
//     }
    public static function boot(){
        parent::boot();
        
        static::creating(function($model){
            // Get the academic year from the 'academic_years' table where enabled is true
            $academicYear = DB::table('academic_years')->where('enabled', true)->value('academic_year');
            
            // Extract the start year and append the last two digits to the ugapp_id
            $startYear = explode('-', $academicYear)[0];
            $lastTwoDigits = substr($startYear, -2);
            
            // Set the number and the ugapp_id
            $model->number = User::max('number') + 1;
            $model->pgapp_id = "ADMPG" . $lastTwoDigits . str_pad($model->number, 5, '0', STR_PAD_LEFT);
        });
    }
}
