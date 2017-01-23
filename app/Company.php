<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function getReport($offset)
    {
        return $this->select(
            'companies.name', 'companies.quota',
            DB::raw('SUM(transfers.transferred) AS used_quota'))
            ->JoinUsers()
            ->JoinTransfers()
            ->havingRaw('SUM(transfers.transferred) > companies.quota')
            ->where('transfers.created_at', '<=', Carbon::now()->subMonth($offset))
            ->groupBy('companies.id')
            ->orderBy('used_quota', 'DESC')
            ->get();
    }

    // Include Users
    function scopeJoinUsers($query)
    {
        return $query->join('users', 'companies.id', '=', 'users.company_id');
    }

    // Include Transfers
    function scopeJoinTransfers($query)
    {
        return $query->join('transfers', 'users.id', '=', 'transfers.user_id');
    }
}
