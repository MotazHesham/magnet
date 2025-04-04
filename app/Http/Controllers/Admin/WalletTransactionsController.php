<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WalletTransactionsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('wallet_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WalletTransaction::query()->select(sprintf('%s.*', (new WalletTransaction)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'wallet_transaction_show';
                $editGate      = false;
                $deleteGate    = false;
                $crudRoutePart = 'wallet-transactions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? WalletTransaction::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('payment_status', function ($row) {
                return $row->payment_status ? WalletTransaction::PAYMENT_STATUS_SELECT[$row->payment_status] : '';
            });
            $table->editColumn('payment_method', function ($row) {
                return $row->payment_method ? WalletTransaction::PAYMENT_METHOD_SELECT[$row->payment_method] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.walletTransactions.index');
    }
    public function show(WalletTransaction $walletTransaction)
    {
        abort_if(Gate::denies('wallet_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.walletTransactions.show', compact('walletTransaction'));
    }
}
