<?php

use Illuminate\Support\Facades\Route;
//use DB;
use App\PaymentTrans;
use Carbon\Carbon;
Route::get('/payment-test','HomeController@paymentTest')->name('paymentTest');
Route::post('/payment-test-response','HomeController@paymentTestResponse')->name('paymentTestResponse');
Route::get('file-upload', 'FileUploadController@fileUpload')->name('file.upload');
Route::post('file-upload', 'FileUploadController@fileUploadPost')->name('file.upload.post');

Route::get('/', function () {
    // return \Spatie\Activitylog\Models\Activity::all();
    return view('welcome');
});



// scol area
Route::get('/scolwelcome1', function () {
    // return \Spatie\Activitylog\Models\Activity::all();
    return view('scol.scol-welcome');
});

Route::get('/scolregister', 'Scol\RegisterController@showRegistrationForm')->name('scol.register');

Route::post('/scolregisterpart1', 'Scol\RegisterController@scolregisterpart1')->name('scolregisterpart1');

///

Route::get('/testzz', function () {

         $paycount = DB::table('tbz_atom_transactions')->join('tb_pgapp','client_code','pgapp_id')
                 ->select('pgapp_id','pgapp_adsc_sl','pgapp_name')
                 -> where('ucity_service',"PG-ENTRANCE-FEE-2023")->where('res_verified',"SUCCESS")->get();
         dd("Total success count : ". $paycount->count()." ".$paycount);
   
});


Route::get('/pwd', function () {
         $cnt = DB::select("SELECT pgapp_id,pgapp_password FROM tb_pgapp WHERE pgapp_id = 'ADMPG2305915'");
         dd($cnt);
});

Route::get('/pmode2023', function () {
     $dt_now = Carbon::now();
        
        $trn_date= $dt_now->toDateString();
        date_default_timezone_set('Asia/Calcutta');
        $datenow = date("d/m/Y");
          return view('auth.registerprojectmode',compact('datenow'));
   
});

Route::post('/forsubjectpmode', 'Auth\RegisterControllerPmode@forsubject');
Route::post('/foroptionpmode', 'Auth\RegisterControllerPmode@foroptionpmode');

Route::get('/pgspa', function () {
         $cnt = DB::select("SELECT distinct pgapp_name FROM tb_pgapp WHERE pgapp_adsc_sl = 994");
         dd($cnt);
});

Route::get('/pg2023deptcount', function () {
         $deptcount = DB::table('tbz_atom_transactions')->join('tb_pgapp','client_code','pgapp_id')->join('tb_admnscheme','adsc_sl','pgapp_adsc_sl')
                 ->select('adsc_name',DB::raw('COUNT(adsc_name)'))
                 ->where('ucity_service',"PG-ENTRANCE-FEE-2023")->where('res_verified',"SUCCESS")->groupby('adsc_name')->get();
         dd("Total departmentwise count : ". $deptcount);
   
});

//Route::get('/applypgadmission', function () {
//    // return \Spatie\Activitylog\Models\Activity::all();
//    return view('welcomepg');
//});
Route::get('/clear', function() {
    $exitCode = Artisan::call('config:cache');
});
Route::get('/vclear', function() {
        $exitCode = Artisan::call('view:clear');
});
//mphil ranklist

Route::post('/mphiladmpayment', 'ViewPaymentController@mphiladmpayment');


Route::get('/MphilPhD/ranklist', 'RankListController@rank_ab');
Route::get('/PG/ranklist', 'RankListController@rank_pg');
Route::get('pg/ranklist/{id}', 'RankListController@pgranklistpdf');
Route::get('/PGranklistnew', 'RankListController@rank_pg1');

Route::get('mphil/selectionlist/{id}', 'RankListController@mphilselectionlistpdf');

Route::get('/phd/selectionlist/{id}', 'RankListController@phdselectionlistpdf');


Route::get('postpg/ranklist/{id}', 'RankListController@mphilranklistpdf');

//phd ranklist

Route::get('/phdranklist/list', 'PostpgEntranceController@rank_phd');
Route::get('/phd/ranklistview/{id}', 'PostpgEntranceController@phdranklistview');
Route::get('/phd/ranklistdownload/{id}', 'PostpgEntranceController@phdranklistpdf');
Route::get('/homepmode', 'HomeController@index1')->name('homepmode');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/religion', 'HomeController@religion');

Route::get('/community', 'HomeController@community');
Route::get('/subcaste', 'HomeController@subcaste');
Route::get('/state', 'HomeController@state');

Route::post('/centopt1', 'HomeController@centopt1');
Route::post('/centopt2', 'HomeController@centopt2');
Route::post('/centopt3', 'HomeController@centopt3');
Route::post('/centopt4', 'HomeController@centopt4');
Route::post('/centopt5', 'HomeController@centopt5');

 
Route::post('/forsubject', 'Auth\RegisterController@forsubject');
Route::post('/getexiststudata', 'Auth\RegisterController@getexiststudata'); 
Route::post('/storepersonal', 'HomeController@store')->name('storepersonal');

Route::post('/storepersonal_data', 'HomeController@storepersonal_data')->name('storepersonal_data');

Route::post('/store_quali', 'HomeController@store_quali')->name('store_quali');
Route::post('/storesemester', 'HomeController@storesemester')->name('storesemester');
Route::post('/store_pmodestream', 'HomeController@store_pmodestream')->name('store_pmodestream');


Route::post('/store_otherinfo', 'HomeController@store_otherinfo')->name('store_otherinfo');
Route::post('/store_image', 'HomeController@store_image')->name('store_image');
Route::post('/store_sign', 'HomeController@store_sign')->name('store_sign');
Route::post('/store_options', 'HomeController@store_options')->name('store_options');
Route::get('/printoption', 'HomeController@printoption')->name('printoption');
Route::get('/pginterviewmemo2022', 'HomeController@interviewmemo')->name('pginterviewmemo2022');
Route::get('/pginterviewmemo2022test', 'HomeController@interviewmemotest')->name('pginterviewmemo2022test');


//Route::post('/store_resultawaiting', 'HomeController@store_resultawaiting')->name('store_resultawaiting');
Route::post('/update_quali', 'HomeController@update_quali')->name('update_quali');
Route::post('/getpreview', 'HomeController@getpreview')->name('getpreview');

Route::post('/pgpayment', 'HomeController@pgpayment')->name('pgpayment');
Route::post('/pgbalancepayment', 'HomeController@pgbalancepayment')->name('pgbalancepayment');

Route::post('home/postpgfeeresponse','HomeController@postpgfeeresponse')->name('postpgfeeresponse');
//cc aven
Route::get('/payResponse', 'PGAdmissionController@payResponse')->name('payResponse');

Route::get('/pay_details','HomeController@pay_details')->name('pay_details');

//Route::get('/studhome','HomeController@studhome')->name('studhome');



Route::get('/allotmentdetails2022','PGAdmissionController@allotmentdetails')->name('allotmentdetails2022');
Route::post('/pgadmissionpayment2022', 'PGAdmissionController@pgadmissionpayment2022')->name('pgadmissionpayment2022');
Route::post('/home/pgadmfeeresponse','PGAdmissionController@pgadmfeeresponse')->name('pgadmfeeresponse');
Route::get('/admfeereceipt2022', 'PGAdmissionController@admfeereceipt2022')->name('admfeereceipt2022');
Route::get('/admfeereceipt2022dept/{id}', 'PGAdmissionControllerDept@admfeereceipt2022dept')->name('admfeereceipt2022dept');

Route::get('/home/paymentstatus', 'HomeController@paymentstatus')->name('paymentstatus');
Route::get('/home/pdf', 'HomeController@getpdf')->name('getpdf');
Route::get('/home/editpg', 'HomeController@editpg')->name('editpg');
Route::get('/pgpdf2022/{id}', 'PGAdmissionControllerDept@pgpdf2022');

//hallticket
 Route::get('/viewranklist', 'PostPGController@viewranklist');
 Route::get('/pay_details/hallticket_view1', 'HallticketController@index');
 Route::get('/hallticketdownload/pdf', 'HallticketController@pdf')->name('hallticketdownload');
 Route::get('/hallticket2022', 'HallticketController@hallticket2022')->name('hallticket2022');



 //option
 Route::get('/optionentry', 'HomeController@getoption')->name('optionentry');
 Route::get('/optionentry23', 'HomeController@getoptionnew')->name('optionentry23');
 Route::get('/documentsupload', 'HomeController@documentsupload')->name('documentsupload');
 Route::post('/store_documents', 'HomeController@store_documents')->name('store_documents');



 Route::get('/reoptionindex', 'HomeController@reoptionindex')->name('reoptionindex');

 //uploadDocuments

 Route::post('/uploadDocuments', 'HomeController@uploadDocuments')->name('uploadDocuments');


 ////interview memo
 Route::get('/pay_details/memodownloads', 'AllotmentControllerPostpg@memodownload');
Route::get('/pay_details/viewallotment', 'ViewAllotmentControllerPostpg@viewallotment');

Route::post('/checkpay', 'HomeController@checkpay')->name('checkpay');
Route::get('/checkpayone', 'HomeController@checkpayone')->name('checkpayone');

//Route::get('/pgallotment', 'ViewAllotmentControllerPostpg@pgallotment'); 
Route::get('/loadview', 'UploadcertificateController@loadview')->name('loadview');
Route::get('/changeexamcentre', 'ViewAllotmentControllerPostpg@changeexamcentre')->name('changeexamcentre');
Route::get('/changeoption', 'ViewAllotmentControllerPostpg@changeoption')->name('changeoption');

Route::get('/loadallotment', 'ViewAllotmentControllerPostpg@loadallotment')->name('loadallotment');
Route::post('/eligibilitytc_upload', 'UploadController@eligibilitytcupload');
Route::get('/downloadmemo', 'ViewAllotmentControllerPostpg@downloadmemo');
Route::get('/uploadcertificates', 'ViewAllotmentControllerPostpg@uploadcertificates');
Route::get('/updatecentreupdatecentre', 'ViewAllotmentControllerPostpg@updatecentre');
Route::post('/updatecentre','ViewAllotmentControllerPostpg@updatecentre');
Route::post('/saveoptions','ViewAllotmentControllerPostpg@saveoptions');
//Route::get('/mphildownloadallotment', 'ViewAllotmentController@mphildownloadallotment');

 Route::get('/pay_details/mphilallotment', 'AllotmentControllerPostpg@mphilallotment');
 Route::get('/pay_details/viewpayment', 'ViewPaymentController@viewpayment')->name('viewpayment');
Route::post('/feeresponse','ViewPaymentController@feeresponse')->name('feeresponse');
Route::get('/pay_details/receiptdownload','ViewPaymentController@receiptdownload')->name('receiptdownload');

Route::get('/downloadmemo', 'DownloadmemoController@downloadmemo');
//**********************user auth********************************
Auth::routes([
    'register'=>true
]);
//**********************///user auth********************************

//***********************admin auth*******************************
Route::prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/home', 'AdminController@index')->name('admin.home');

    // Login routes
    Route::get('/', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/', 'Admin\LoginController@login');

    // Logout route
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Register routes
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    // Password reset routes
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');

});
//////////////////////
