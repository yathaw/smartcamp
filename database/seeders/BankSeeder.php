<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bankLists =[

            array('/storage/bank/cashmoney.png', 'Cash Money'),
            array('/storage/bank/visa.png', 'Visa'),
            array('/storage/bank/jcb.png', 'JCB'),
            array('/storage/bank/paypal.png', 'Paypal'),
            array('/storage/bank/master.png', 'Master'),
            array('/storage/bank/truemoney.png', 'True Money'),
            array('/storage/bank/agd_bank.png', 'AGD Bank'),
            array('/storage/bank/aya_bank.png', 'AYA Bank'),
            array('/storage/bank/cb_bank.png', 'CB Bank'),
            array('/storage/bank/kbz_bank.png', 'KBZ Bank'),
            array('/storage/bank/k_pay.png', 'K Pay'),
            array('/storage/bank/mab_bank.png', 'MAB Bank'),
            array('/storage/bank/onepay.png', 'One Pay'),
            array('/storage/bank/wavemoney.png', 'Wave Money'),
            array('/storage/bank/wavepay.png', 'Wave Pay'),
            array('/storage/bank/yoma_bank.png', 'Yoma Bank')
        ];
        foreach ($bankLists as $bankList) {
            $bank = new Bank;
            $bank->name = $bankList[1];
            $bank->logo = $bankList[0];
            $bank->save();
        }
    }
}
