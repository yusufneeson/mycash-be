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
            Account::factory(5)->create()->each(function ($acc) use ($user) {
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
                        $del->delete();
                        return false;
                    }

                    return $acc;
                });

            $accounts->each(function ($a) use ($user) {
                if (is_bool($a)) {
                    dump($a, $user);
                } else {
                    // Transaction::factory(50)->create()->each(function ($t) use ($a) {
                    //     $t->account_id = $a->id;
                    //     $t->save();



                    //     // if ($t->type == 'conv') {
                    //     //     Convert::create([
                    //     //         'transaction_id' => $t->id,
                    //     //         'dest_id' => Account::query()
                    //     //             ->where('user_id', $acc->user_id)
                    //     //             ->get()
                    //     //             ->shuffle()
                    //     //             ->pluck('id')
                    //     //             ->first()
                    //     //     ]);
                    //     // }
                    // });
                }
            });
            // if (is_bool($accounts)) {
            //     dd($accounts);
            // }
        });
    }
}
