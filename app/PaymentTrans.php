<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTrans extends Model
{
    public $timestamps = false;
    public $connection = "pgsql2";
    protected $table='tbz_atom_transactions';
    protected $primaryKey = 'trans_id';
    protected $fillable = [
        'merchantid', 'merchanttxnid', 'trans_amt', 'tdate','client_code','ucity_service','trans_timestamp',
        'res_verfied','res_bid',
        'res_bankname','res_atomtxn_id','res_discriminator','res_card_number','res_txn_date','res_surcharge','res_udf9_clientcode','res_reconstatus',
        'res_sdt','account_code'
    
    ];
}
