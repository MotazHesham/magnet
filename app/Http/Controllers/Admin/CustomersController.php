<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyCustomerRequest;
use App\Http\Requests\Admin\StoreCustomerRequest;
use App\Http\Requests\Admin\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Customer::with(['user'])->select(sprintf('%s.*', (new Customer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'customer_show';
                $editGate      = 'customer_edit';
                $deleteGate    = 'customer_delete';
                $crudRoutePart = 'customers';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->editColumn('user.block', function ($row) {
                return '<label class="c-switch c-switch-pill c-switch-success">
                    <input onchange="updateStatuses(this, \'block\', \'App\\\\Models\\\\User\')" 
                        value="' . $row->user_id . '" 
                        type="checkbox" 
                        class="c-switch-input" ' . ($row->user->block ? 'checked' : '') . '>
                    <span class="c-switch-slider"></span>
                </label>'; 
            });
            $table->editColumn('user.phone', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->phone) : '';
            });
            $table->editColumn('wallet_balance', function ($row) {
                return $row->wallet_balance ? $row->wallet_balance : '';
            });
            $table->editColumn('points', function ($row) {
                return $row->points ? $row->points : '';
            });
            $table->editColumn('can_scratch', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->can_scratch ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'can_scratch','user.block']);

            return $table->make(true);
        }

        return view('admin.customers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customers.create', compact('users'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => $request->password,
            'approved' => 1,
            'user_type' => 'customer',
            'phone' => $request->phone, 
        ]);

        Customer::create([
            'user_id' => $user->id,
            'wallet_balance' => 0,
            'points' => 0,
            'can_scratch' => 1,
        ]);

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return redirect()->route('admin.customers.index');
    }

    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        $customer->load('user');
        $user = $customer->user;

        return view('admin.customers.edit', compact('customer', 'user'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $user = User::find($customer->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => $request->password, 
            'phone' => $request->phone, 
        ]);
        if ($request->input('photo', false)) {
            if (! $user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }

        return redirect()->route('admin.customers.index');
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->load(['user' => ['userAddresses' => ['region','city','district'], 'userProductReviews.product', 'userCustomerPoints' => ['order','product']]]);
        $user = $customer->user;

        return view('admin.customers.show', compact('customer','user'));
    }

    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->user()->delete();
        $customer->delete();

        return back();
    }

    public function massDestroy(MassDestroyCustomerRequest $request)
    {
        $customers = Customer::find(request('ids'));

        foreach ($customers as $customer) {
            $customer->user()->delete();
            $customer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
