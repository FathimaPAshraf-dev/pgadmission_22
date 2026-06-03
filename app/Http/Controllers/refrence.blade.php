<?php
ob_start();
session_start();
unset($_SESSION['regid']);
include('connect.php');
include_once("validation_class.php"); //for server side validation
date_default_timezone_set('Asia/Kolkata');
//print_r($_POST);

/*foreach($_POST as $k => $v)
{
echo $k."<br>";
}*/
//exit;
//print_r($_POST);
//exit();

$prefix = "POSTPG";


// $obj = new validation();
// print_r($_POST);

//$obj->add_fields($program, 'req', 'Please fill program');

//$obj->add_fields($mphilphdapp_stud_name, 'req', 'Please fill student name');
//$obj->add_fields($mphilphdapp_stud_name, 'name', 'name only in  student name');

//$obj->add_fields($mphilphdapp_dob, 'req', 'Please fill date of birth');
//$obj->add_fields($mphilphdapp_dob, 'date', 'Enter a valid date of birth');

//$obj->add_fields($mphilphdapp_gender_sl, 'req', 'Please fill gender');

//$obj->add_fields($mphilphdapp_nationality, 'req', 'Please fill nationality');
//$obj->add_fields($mphilphdapp_nationality, 'req', 'Please enter valid nationality');

//$obj->add_fields($mphilphdapp_relgn_sl, 'req', 'Please fill relegion');
//$obj->add_fields($mphilphdapp_comm_sl, 'req', 'Please fill community');
//$obj->add_fields($mphilphdapp_caste_sl, 'req', 'Please fill caste');

//$obj->add_fields($mphilphdapp_commaddress, 'req', 'Please fill communication address');
//$obj->add_fields($mphilphdapp_commaddress, 'address', 'Please fill valid address');

//$obj->add_fields($mphilphdapp_permaddress, 'req', 'Please fill permanant address');
//$obj->add_fields($mphilphdapp_permaddress, 'address', 'Please fill valid permanant address');

//$obj->add_fields($mphilphdapp_landlineno, 'req', 'Please fill landline  number');
//$obj->add_fields($mphilphdapp_mobileno, 'num', 'Please fill valid  mobilenumber');
//$obj->add_fields($mphilphdapp_email, 'req', 'Please fill email');
//$obj->add_fields($paymntcombo, 'req', 'Please fill mode of payment');

   // $obj->add_fields($mphilphdfee_chalan_ddno, 'remarks', 'special chars not allowed in chelan no');
//$obj->add_fields($mphilphdfee_chalan_ddno1, 'remarks', 'special chars not allowed in dd no');

//$obj->add_fields($mphilphdfee_bank, 'remarks', 'special chars not allowed in bank');
//$obj->add_fields($mphilphdfee_bank1, 'remarks', 'special chars not allowed in bank');

//$obj->add_fields($mphilphdfee_branch, 'remarks', 'special chars not allowed in branch');
//$obj->add_fields($mphilphdfee_branch1, 'remarks', 'special chars not allowed in branch');

//$obj->add_fields($mphilphdquali_exam, 'remarks', 'special chars not allowed');


//for($i=0;$i<2;$i++)
// {
//$mphilphdquali_exam = $_REQUEST['mphilphdquali_exam'.$i];
//$obj->add_fields($mphilphdquali_exam, 'remarks', 'special chars not allowed');

//$mphilphdquali_institute = $_REQUEST['mphilphdquali_institute'.$i];
//$obj->add_fields($mphilphdquali_institute, 'remarks', 'special chars not allowed');

//$mphilphdquali_uty = $_REQUEST['mphilphdquali_uty'.$i];
//$obj->add_fields($mphilphdquali_uty, 'remarks', 'special chars not allowed');

//$mphilphdquali_subjects = $_REQUEST['mphilphdquali_subjects'.$i];
//$obj->add_fields($mphilphdquali_subjects, 'remarks', 'special chars not allowed');

//$mphilphdquali_year = $_REQUEST['mphilphdquali_year'.$i];
///$obj->add_fields($mphilphdquali_year, 'remarks', 'special chars not allowed');


//$mphilphdquali_gp_per = $_REQUEST['mphilphdquali_gp_per'.$i];

//}

///$obj->add_fields($paymntcombo, 'req', 'Please fill mode of payment');

//$obj->add_fields($mphilphdjrf_regno, 'letternumb', 'Please fillreg no properly');
//$obj->add_fields($mphilphdjrf_year, 'num', 'date only in year');

//$obj->add_fields($mphilphdemp_details, 'remarks', 'special chars not allowed in details');
//$obj->add_fields($mphilphdemp_teach_exp, 'letternumb', 'no of years not valid');
//$obj->add_fields($mphilphdapp_addinfo, 'remarks', 'special chars not allowed in daaitional info');
//echo $paymntcombo;
//exit();
// if($paymntcombo==1 ){
//$obj->add_fields($mphilphdfee_amount, 'req', 'Please fill amount');
//$obj->add_fields($mphilphdfee_chalan_ddno, 'req', 'Please fill chalan/dd number');
// $obj->add_fields($mphilphdfee_date, 'req', 'Please fill payment date');

//$obj->add_fields($mphilphdfee_bank, 'req', 'Please fill bank');
//$obj->add_fields($mphilphdfee_branch, 'req', 'Please fill branch');
// $obj->add_fields($captcha_number, 'req', 'Please fill captcha');
// }

// if($paymntcombo==2){
// $obj->add_fields($mphilphdfee_amount, 'req', 'Please fill amount');
//$obj->add_fields($mphilphdfee_chalan_ddno, 'req', 'Please fill chalan/dd number');
// $obj->add_fields($mphilphdfee_date, 'req', 'Please fill payment date');

//$obj->add_fields($mphilphdfee_bank, 'req', 'Please fill bank');
//$obj->add_fields($mphilphdfee_branch, 'req', 'Please fill branch');
// $obj->add_fields($captcha_number, 'req', 'Please fill captcha');
//}

// $error = $obj->validate();

//echo $error;exit();
// if($error)
// {
//echo "error here";
// $_SESSION['error']=$error;
//header("location:regform.php?error=0");
// }
//else
//{

//$sqldep = "SELECT dept_name FROM  tb_program WHERE pgm_type = '$mphilphdapp_dept_sl' ";
//$resdep = $db->query($sqldep);
//list($dept_name)= $db->fetch_array($resdep);

//$admn_name = $prefix." ".$dept_name." ".date('Y')." ADMISSION";

//$sqladsc = "SELECT adsc_sl, adsc_admnyear, adsc_name FROM tb_admnscheme WHERE adsc_name = '$admn_name' AND  adsc_admnyear = '".date('Y')."'";
//$resadsc = $db->query($sqladsc);
//list($mphilphdpgm_adsc_sl) = $db->fetch_array($resadsc);



$stuchar = "ADMPOSTPG";//RES for RESEARCH

$stuyear = date("y");

$first_char = $stuchar.$stuyear."1";
$stunum = 10001;
$stuid = $stuchar.$stuyear.$stunum;

$result_count = $db->query("select count(*) as cnt from tb_postpgapp"); //counting users
$row_count = $db->fetch_array($result_count);
$no_of_rows = $row_count['cnt'];
//exit;


if($no_of_rows > 0)
{
$sql_mphilphdappid = $db->query("SELECT MAX(postpgapp_appid) as studid FROM tb_postpgapp");
list($max_mphilphdapp_id) = $db->fetch_array($sql_mphilphdappid);
// $substudid = substr($max_mphilphdapp_id,8,5); //OLD one ID for ADMRES
$substudid = substr($max_mphilphdapp_id,11,5);
$newstud_num = $substudid + 1;
$mphilphdapp_id = $stuchar.$stuyear.$newstud_num;
}
else
{
$mphilphdapp_id = $stuid;
}

//echo "ID ".$mphilphdapp_id;
//exit;

$mphilphdapp_password = "res".rand();

/* Creating Research student ID End*/
$year = 15; /*  $year = $stuyear;  */
$namedir = "adm".$year;
$innerdir = "res";
$filename = $_FILES['mphilphdapp_photo']['name'];

// rmdir($namedir.'/'.$innerdir);
if(file_exists($namedir))
{
}
else
{
mkdir($namedir, 0777);
//mkdir($namedir.'/'.$innerdir,0777);
}
if(file_exists($namedir.'/'.$innerdir))
{
}
else
{
// mkdir($namedir, 0777);
mkdir($namedir.'/'.$innerdir,0777);
}


$uploadname = $mphilphdapp_id.'.jpg';
$filename = $uploadname;
//$newname = $_SERVER['DOCUMENT_ROOT'].'/ssus/'.$namedir.'/'.$innerdir.'/'.$filename;
$newname = $namedir.'/'.$innerdir.'/'.$filename;
move_uploaded_file($_FILES['mphilphdapp_photo']['tmp_name'],$newname);
/* $image = new SimpleImage();
$image->load($_FILES['pgapp_photo']['tmp_name']);
$image->resize(120,140);
$image->save($newname);
$image->output();*/
$mphilphdapp_photo = $filename;

$date_pick = $mphilphdapp_dob;
list($day_dob,$month_dob,$year_dob)=split('/',$date_pick);
$mphilphdapp_dob = trim($year_dob).'-'.trim($month_dob).'-'.trim($day_dob);



$date_pick = $mphilphdfee_date;
list($day_dob,$month_dob,$year_dob)=split('/',$date_pick);
$mphilphdfee_date = trim($year_dob).'-'.trim($month_dob).'-'.trim($day_dob);

$admissionYear = date("Y");

$mphilphdapp_ipaddress = $_SERVER['REMOTE_ADDR'];



 $sqlmail = "SELECT  postpgapp_email FROM tb_postpgapp WHERE  postpgapp_mobile = '$mphilphdapp_mobileno'";

$resmail = $db->query($sqlmail);
list($email) = $db->fetch_array($resmail);
//$curDate =date("Y-m-d");
// print_r("till here");
//        return;
if($email == "")
{



 $sql1 = "INSERT INTO tb_postpgapp(postpgapp_appid, postpgapp_app_password,postpgapp_admission_year,postpgapp_pgmtyp_sl_ref,postpgapp_adsc_sl_ref,
postpgapp_studname,postpgapp_father_guardian_name,postpgapp_photo,postpgapp_dob,postpgapp_age,postpgapp_gender_sl,postpgapp_nationality,postpgapp_religion_sl,
postpgapp_community_sl,postpgapp_caste_sl,postpgapp_subcaste_sl,postpgapp_comn_address,postpgapp_permt_address,postpgapp_landphone,postpgapp_mobile,postpgapp_email,
postpgapp_additional_info,postpgapp_ipaddress,ph_status,ph_type,pgcourse_status,mphilcourse_status)


VALUES

('$mphilphdapp_id', '$mphilphdapp_password', '$admissionYear', '$mphilphdapp_mpstr_sl', '$program', '$mphilphdapp_stud_name',
'$mphilphdapp_guardian_name', '$mphilphdapp_photo', '$mphilphdapp_dob', '$mphilphdapp_age', '$mphilphdapp_gender_sl',
'$mphilphdapp_nationality', '$mphilphdapp_relgn_sl', '$mphilphdapp_comm_sl', '$mphilphdapp_caste_sl', '$mphilphdapp_subcaste_sl',
'$mphilphdapp_commaddress', '$mphilphdapp_permaddress', '$mphilphdapp_landlineno','$mphilphdapp_mobileno','$mphilphdapp_email','$mphilphdapp_addinfo','$mphilphdapp_ipaddress','$mphilph','$mphilph_type','$awaiting','$awaiting_mphil')";










//  $sql1 = "INSERT INTO tb_postpgapp(postpgapp_appid, postpgapp_app_password,postpgapp_admission_year,postpgapp_pgmtyp_sl_ref,postpgapp_adsc_sl_ref,
// postpgapp_studname,postpgapp_father_guardian_name,postpgapp_photo,postpgapp_dob,postpgapp_age,postpgapp_gender_sl,postpgapp_nationality,postpgapp_religion_sl,
// postpgapp_community_sl,postpgapp_caste_sl,postpgapp_subcaste_sl,postpgapp_comn_address,postpgapp_permt_address,postpgapp_landphone,postpgapp_mobile,postpgapp_email,
// postpgapp_additional_info,postpgapp_ipaddress,ph_status,ph_type)


// VALUES

// ('$mphilphdapp_id', '$mphilphdapp_password', '$admissionYear', '$mphilphdapp_mpstr_sl', '$program', '$mphilphdapp_stud_name',
// '$mphilphdapp_guardian_name', '$mphilphdapp_photo', '$mphilphdapp_dob', '$mphilphdapp_age', '$mphilphdapp_gender_sl',
// '$mphilphdapp_nationality', '$mphilphdapp_relgn_sl', '$mphilphdapp_comm_sl', '$mphilphdapp_caste_sl', '$mphilphdapp_subcaste_sl',
// '$mphilphdapp_commaddress', '$mphilphdapp_permaddress', '$mphilphdapp_landlineno','$mphilphdapp_mobileno','$mphilphdapp_email','$mphilphdapp_addinfo','$mphilphdapp_ipaddress','$mphilph','$mphilph_type')";
//print_r($sql1);
//exit;

$res1 = $db->query($sql1);



//print_r($res1);
               // print_r($mphilphdapp_id);
               // return;

//exit;
$sqlselectInsertID = "SELECT  postpgapp_sl FROM tb_postpgapp WHERE postpgapp_appid = '$mphilphdapp_id'";
                       
$resmail123 = $db->query($sqlselectInsertID);
list($insertKey) = $db->fetch_array($resmail123);
//print_r($insertKey);
//exit;
if($res1)
{
if($program <> "")
{
$sqlmphilphdpgm = "INSERT INTO  tb_postpgpgm(postpgpgm_postpgapp_sl_ref, postpgpgm_adsc_sl_ref,postpgpgm_postpgapp_appid)VALUES('$insertKey','$program','$mphilphdapp_id')";
$db->query($sqlmphilphdpgm);
}
}
//exit();
if($res1)
{
                    if($paymntcombo!=4)
                    {
/*echo "<br>".*/

if($mphilphdfee_chalan_ddno==""){

$chalandd= $mphilphdfee_chalan_ddno1;
}else{
$chalandd= $mphilphdfee_chalan_ddno;
}

if($mphilphdfee_bank==""){

$bank =$mphilphdfee_bank1;
}else{
$bank =$mphilphdfee_bank;
}

if($mphilphdfee_branch==""){

$branch =$mphilphdfee_branch1;
}else{
$branch =$mphilphdfee_branch;
}
                    }
                    else
                    {
                        $chalandd="";
                        $bank ="";
                        $branch="";
                    }

  $sql2 = "INSERT INTO tb_postpgfee(postpgfee_postpgapp_sl_ref, postpgfee_postpgapp_appid,postpgfee_payoption,postpgfee_ddchallan_num, postpgfee_amount,postpgfee_ddchallan_date,postpgfee_bank,postpgfee_branch)
VALUES ('$insertKey','$mphilphdapp_id','$paymntcombo', '$chalandd','$mphilphdfee_amount', '$mphilphdfee_date', '$bank','$branch')";
$res2 = $db->query($sql2);

}
//exit();

for($i=0;$i<2;$i++)
{
$mphilphdquali_exam = $_REQUEST['mphilphdquali_exam'.$i];
$mphilphdquali_institute = $_REQUEST['mphilphdquali_institute'.$i];
$mphilphdquali_uty = $_REQUEST['mphilphdquali_uty'.$i];
$mphilphdquali_subjects = $_REQUEST['mphilphdquali_subjects'.$i];
$mphilphdquali_year = $_REQUEST['mphilphdquali_year'.$i];
$mphilphdquali_gp_per = $_REQUEST['mphilphdquali_gp_per'.$i];

if($mphilphdquali_institute <> "")
{
/*echo "<br>".*/
                            $mphilphdquali_institute=str_replace("'"," ",$mphilphdquali_institute);
                            $mphilphdquali_uty=str_replace("'"," ",$mphilphdquali_uty);
                            $mphilphdquali_subjects=str_replace("'"," ",$mphilphdquali_subjects);
if($res2)
{
$sql3 = "INSERT INTO tb_postpgquali(postpgquali_postpgapp_sl_ref, postpgquali_postpgapp_appid,postpgquali_exam,postpgquali_institute, postpgquali_university, postpgquali_subjects,postpgquali_year, postpgquali_gp_per) VALUES('$insertKey', '$mphilphdapp_id','$mphilphdquali_exam','$mphilphdquali_institute', '$mphilphdquali_uty', '$mphilphdquali_subjects','$mphilphdquali_year', '$mphilphdquali_gp_per')";
$res3 = $db->query($sql3);
}
}
}

if($res1)
{

if($mphilphdjrf_status == "1")
{

/*echo "<br>".*/
$sql4 = "INSERT INTO tb_postpgjrf( postpgjrf_postpgapp_sl_ref,postpgjrf_postpgapp_appid,postpgjrf_option, postpgjrf_regno, postpgjrf_year)
VALUES ( '$insertKey','$mphilphdapp_id', '$mphilphdjrf_status','$mphilphdjrf_regno', '$mphilphdjrf_year')";
$db->query($sql4);
}
if($mphilphdemp_status == "1" || $mphilphdemp_status == "0")
{
/*echo "<br>".*/
$sql5 = "INSERT INTO tb_postpgemployment( postpgemployment_postpgapp_sl_ref, postpgemployment_postpgapp_appid,postpgemployment_option,postpgemployment_details, postpgemployment_teach_exp)
VALUES ('$insertKey','$mphilphdapp_id', '$mphilphdemp_status','$mphilphdemp_details', '$mphilphdemp_teach_exp')";
$db->query($sql5);
}
if($mphilphdpaper_status == "1")
{
/*echo "<br>".*/
$sql6 = "INSERT INTO tb_postpgpaperpublish(postpgpaperpublish_postpgapp_sl_ref,postpgpaperpublish_postpgapp_appid, postpgpaperpublish_info,postpgpaperpublish_option)
VALUES ('$insertKey','$mphilphdapp_id', '$mphilphdpaperdet_details','$mphilphdpaper_status')";
$db->query($sql6);
}

$_SESSION['regid'] = $mphilphdapp_id;
// exit();
// EMAIL TO APPLICANTS
$to = $mphilphdapp_email;
$subject = "POST PG Registration Details";
 
 
$message = 'Hi '.$mphilphdapp_stud_name.',<br><table border="0"><tr><th colspan="2"><h2>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT, KALADY</h2></th> </tr> <tr><th colspan="2"><h3>M.Phil/Integrated MPhil-Ph.D/Direct Ph.D Registration Details</h3></th> </tr><tr><td colspan="2">Dear '.$mphilphdapp_stud_name.', Your application has been registered.</td><tr><td colspan="2">Following are the details of your registration;</td><tr><td>Registration ID</td><td>'.$mphilphdapp_id.'</td></tr><tr><td>Password</td><td>'.$mphilphdapp_password.'</td></tr></table>';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers
$headers .= 'From: <admin@ssus.ac.in>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers); // EDITEDD

//EMAIL TO SYSTEM ADMIN
$to = "sadhikali@ssus.ac.in";
$subject = "POST PG Registration Details";
 
 
//$res_stream = $db->query("SELECT mpstr_name FROM tb_mphil_stream WHERE mpstr_sl = '$mphilphdapp_mpstr_sl' ");
//list($mpstr_name) = $db->fetch_array($res_stream);  

//$res_dept = $db->query("SELECT dept_name FROM tb_department WHERE dept_sl = '$mphilphdapp_dept_sl' ");
//list($dept_name) = $db->fetch_array($res_dept);  
 

 
$message = '<table border="0"> <tr><th colspan="2"><h2>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT, KALADY</h2></th> </tr><tr><th colspan="2"><h3>POST PG Registration Details</h3></th> </tr><tr><td colspan="2">An application has been registered.</td><tr><td colspan="2">Following are the details of registration;</td><tr><td>Registration ID</td><td>'.$mphilphdapp_id.'</td></tr><tr><td>Name</td><td>'.$mphilphdapp_stud_name.'</td></tr><tr><td>Registered Date</td><td>'.date('d/m/Y').'</td></tr><tr><td>Stream</td><td>POST PG</td></tr><tr><td>Department</td><td>'.$program.'</td></tr></table>';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers
$headers .= 'From: <admin@ssus.ac.in>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers); //EDITEDD


$ch = curl_init();
$mob = urlencode($mphilphdapp_mobileno);
$name = urlencode($mphilphdapp_stud_name);
$stream = urlencode($program);
$year = date('Y');
$regid = urlencode($mphilphdapp_id);
$pass = urlencode($mphilphdapp_password);

curl_setopt($ch, CURLOPT_URL,"http://api.chandnas.com/SendSMS.aspx?UserName=suexam&password=india2012&MobileNo=$mob&SenderID=SUEXAM&CDMAHeader=910000000130&Message=Dear%20$name,Your%20application%20for%20$stream%20Admission%20$year%20of%20SSUS,%20Kalady%20has%20been%20registered%20with%20Registration%20ID%20:%20$regid%20and%20Password%20:%20$pass.%20SU,%20Kalady.");


curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  

curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);


header("location:registered_1.php");
}
}


else
{
header("location:regform_1.php?msg=3");
}


//}
?>