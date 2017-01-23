<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use App\Transfer;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Http\Request;

class MainController extends Controller
{
    const MONTHS_FOR_RANDOM = 6;

    public function index(Request $request)
    {
        $months_ago = self::MONTHS_FOR_RANDOM;
        $date = Carbon::now()->subMonth($months_ago);
        $months = [];

        // List with months
        for ($i = 0; $i < $months_ago; ++$i)
        {
            $date->addMonth();

            $months[] = [
                'value' => $months_ago - 1 - $i,
                'label' => $date->format('F')
            ];
        }

        $companies = Company::all();
        $users = User::all();

        return view('main', compact('companies', 'users', 'months'));
    }

    public function generate(Request $request)
    {
        // Remove current transfers
        Transfer::truncate();

        // Get users chunks
        User::chunk(100, function ($users)
        {
            $faker = Faker::create();
            $months_ago = self::MONTHS_FOR_RANDOM;

            foreach ($users as $user)
            {
                for ($i = $months_ago - 1; $i >= 0; --$i)
                {
                    $date = Carbon::now()->subMonth($i);
                    $start = clone $date->startOfMonth();
                    $end = clone $date->endOfMonth();

                    for ($ii = 0; $ii < rand(10, 110); ++$ii)
                    {
                        // Create transfer record
                        $transfer = new Transfer();
                        $transfer->user_id = $user->id;
                        $transfer->transferred = $this->randomBytes();
                        $transfer->resource = $faker->domainName();
                        $transfer->created_at = $faker->dateTimeBetween($start, $end)->format('Y-m-d H:i:s');
                        $transfer->save();
                    }
                }
            }
        });

        if ($request->ajax())
        {
            return trans('main.successMsg');
        }
        else
        {
            return redirect('/');
        }
    }

    public function report(Request $request, Company $companies, $monthOffset = 0)
    {
        $data = $companies->getReport($monthOffset);

        return view('report', compact('data'));
    }

    function randomBytes()
    {
        $min = 100;
        $max = 11000000000000;
        $length = rand(3, 14);

        $val = '';

        for ($i = 0; $i < $length; ++$i)
        {
            $number = rand(0, 9);
            $val .= $number;
        }

        if (substr($val, 0, 1) == 0)
        {
            $val = $min;
        }
        else if ($val > $max)
        {
            $val = $max;
        }

        return $val;
    }
}
