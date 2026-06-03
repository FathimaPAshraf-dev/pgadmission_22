<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TbzCcavenueTxn extends Model
{
    public $timestamps = false; // Disable if the table doesn't have created_at/updated_at
    public $connection = 'pgsql2'; // Use the same DB connection as PaymentTrans
    protected $table = 'tbz_ccavenue_txns'; // Your table name
    protected $primaryKey = 'trans_id'; // Update if your PK is different

    protected $fillable = [
        'merchantid',
        'trans_amt',
        'client_code',
        'ucity_service',
        'trans_timestamp',
        'res_verified',
        'res_bid',
        'res_bankname',
        'res_atomtxn_id',
        'tdate',
        'res_discriminator',
        'res_card_number',
        'res_txn_date',
        'res_surcharge',
        'res_udf9_clientcode',
        'res_sdt',
        'merchanttxnid',
        'account_code',
        'record_status',
        'tid',
        'order_id',
        'order_status',
        'amount',
        'bank_ref_no',
        'billing_name',
        'billing_email',
        'billing_tel',
        'merchant_param1_app_id',
        'merchant_param2_ucity_service',
        'merchant_param3_regno',
        'cancel_url',
        'redirect_url',
        'merchant_id',
        'created_at',
        'updated_at',
        'trans_id',
        'tracking_id',
        'merchant_param4_dept_sl',
        'merchant_param5_centre_sl',
        'payment_mode',
        'card_name',
        'failure_message',
        'status_message',
        'billing_zip',
        'billing_city',
        'fee_splitup',
        'sub_account_id'
    ];
}
