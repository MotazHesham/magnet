<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\WalletTransaction;
use App\Utils\DataTableHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WalletTransactionsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('wallet_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'columns' => [ 
                    'type' => function ($row) {
                        return $row->type ? WalletTransaction::TYPE_SELECT[$row->type] : '';
                    }, 
                    'payment_status' => function ($row) {
                        return $row->payment_status ? WalletTransaction::PAYMENT_STATUS_SELECT[$row->payment_status] : '';
                    },
                    'payment_method' => function ($row) {
                        return $row->payment_method ? WalletTransaction::PAYMENT_METHOD_SELECT[$row->payment_method] : '';
                    },
                ],
                'gates' => [
                    'view' => 'wallet_transaction_show',
                    'edit' => false,
                    'delete' => false
                ],
                'crudRoutePart' => 'wallet-transactions'
            ];

            $handler = new DataTableHandler(new WalletTransaction(), $config);
            return $handler->handle($request);
        }

        return view('admin.customer.walletTransactions.index');
    }
    public function show(WalletTransaction $walletTransaction)
    {
        abort_if(Gate::denies('wallet_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.customer.walletTransactions.show', compact('walletTransaction'));
    }
}
