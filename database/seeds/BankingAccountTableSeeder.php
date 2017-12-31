<?php

use App\BankingAccount;
use Illuminate\Database\Seeder;

class BankingAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           $bankingAccount = BankingAccount::create([
               'bank' => 'Banco Macro',
               'branch_office' => 'Wanda, Misiones',
               'account_holder' => 'Jose Luis Acosta',
               'cuit' => 20104047778,
               'type' => 'cuenta_corriente',
               'nro_cta' => 300709412292801,
               'cbu' => 2850007230094122928011,
               'active' => true
           ]);

           if ($bankingAccount) $bankingAccount = null;
    }
}
