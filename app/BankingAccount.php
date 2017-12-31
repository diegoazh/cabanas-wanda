<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankingAccount extends Model
{
    protected $table = 'banking_account';
    protected $fillable = ['bank', 'branch_office', 'account_holder', 'cuit', 'type', 'nro_cta', 'cbu'];

}
