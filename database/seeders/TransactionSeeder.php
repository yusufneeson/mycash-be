<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Convert;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create()->each(function ($user) {
            Account::factory(rand(2, 5))->create()->each(function ($acc) use ($user) {
                $acc->user_id = $user->id;
                $acc->save();
            });

            $accounts = Account::query()
                ->where('user_id', $user->id)
                ->get()
                ->map(function ($acc) {
                    $del = Account::query()
                        ->where('user_id', $acc->user_id)
                        ->where('name', $acc->name)
                        ->where('id', '>', $acc->id)
                        ->first();
                    if ($del) {
                        $del->name = $del->name . '_2';
                        $del->save();
                    }

                    return $acc;
                });

            $accounts->each(function ($a) {
                $cek = Transaction::where('account_id', $a->id)->first();
                if (!$cek) {
                    Transaction::create([
                        'account_id' => $a->id,
                        'type' => 'in',
                        'amount' => random_int(230000, 8790000),
                        'description' => 'Saldo Awal'
                    ]);
                }

                Transaction::factory(50)->create()->each(function ($t) use ($a) {
                    $t->account_id = $a->id;
                    $t->save();

                    if ($t->type == 'conv') {
                        Convert::create([
                            'transaction_id' => $t->id,
                            'dest_id' => Account::query()
                                ->where('user_id', $a->user_id)
                                ->get()
                                ->shuffle()
                                ->pluck('id')
                                ->first()
                        ]);
                    }
                });
            });
        });
    }
}
