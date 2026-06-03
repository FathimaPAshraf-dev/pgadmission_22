<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
//use Intervention\Image\ImageManagerStatic as Image;
//use Illuminate\Support\Facades\Image;
//use App\Http\Controllers\Auth\Image;
//use Request;
//use App\Http\Requests;
use App\User;
use App\Studadmin;
// use Hash;
use Session;
use DB;
use Illuminate\Support\Facades\Auth;



class UploadController extends Controller
{
 public function eligibilitytcupload(Request $request) {



   $val =Auth::user()->pgapp_id;

   // $val ="ADMPG2107624";

$input = $request->all();


//parse_str($input, $finalarray);
//  $input['regsslc'];








  $idget = DB::select("select * from tb_pgapp where pgapp_id='$val'");
  

 foreach($idget as $key)
              {
                  $apnoid=$key->pgapp_id;
              }






// $value=Input::get('hdnsylUpload');
$value="file_q142";

if($value=='file_q142')
{


//        $input = $request->all();
   
    if($_FILES['filesyl']['name']!=''){



       
//        return $_FILES["file_q12"]['name'];
        $sourcePath = $_FILES['filesyl']['tmp_name'];




//$targetPath = "images/".$newq;

$idnew=$apnoid;


$dot=".";

$path = $_FILES['filesyl']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
//$newq="123newtext.".$ext;
$newq=$idnew.".".$ext;
$targetPath = "transfercertificate/".$newq;



$photocheck=DB::select("select tc_path from tb_pgapp where pgapp_id='$apnoid'");
foreach($photocheck as $keyc)
              {
                  $tc=$keyc->tc_path;
              }



$newi=substr($tc,0,12);

$newd=substr($tc,13,16);

//return $newi;
//return "eeerrrrr";

if($apnoid==$newi)
{

return 'exist';



}



else
{
//$updatemrk = DB::update('update tb_onlinecertificate set ugapp_photo=?,sslcyrmnthdoc=?,sslcregnodoc=?,sslcmarkdoc=? where ugapp_id=?', [$newq,$input['ymsslc'],$input['regsslc'],$input['marksslc'], $apnoid]);
if($ext!='pdf')
{

  return 5;
}



$updatemrk = DB::update('update tb_pgapp set tc_path=? where pgapp_id=?', [$newq,$apnoid]);








       if(move_uploaded_file($sourcePath,$targetPath)) {

//to be insert query into image column of tb_onlinecertificate

          // chmod("/var/www/html/iqac/public/images/".$targetPath,0777);
           $name=strval($targetPath);
           return $name;

      }

    }
     

//newwwwwwwwwww




 





         
}
return 'null';
}
            
         }

   
    
    
    
 
}
