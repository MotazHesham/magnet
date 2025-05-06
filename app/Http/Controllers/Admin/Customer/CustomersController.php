<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroyCustomerRequest;
use App\Http\Requests\Admin\StoreCustomerRequest;
use App\Http\Requests\Admin\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use App\Utils\DataTableHandler;
use App\Utils\MediaHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomersController extends Controller
{
    use MediaUploadingTrait;

    public function __construct(
        protected MediaHandler $mediaHandler
    ) {}

    public function index(Request $request)
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $config = [
                'relations' => ['user'],
                'columns' => [ 
                    'user_name' => function ($row) {
                        return $row->user ? $row->user->name : '';
                    },
                    'user.email' => function ($row) {
                        return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
                    },
                    'user.block' => [
                        'type' => 'checkbox',
                        'options' => [
                            'model' => User::class,  
                        ]
                    ],
                    'user.phone' => function ($row) {
                        return $row->user ? (is_string($row->user) ? $row->user : $row->user->phone) : '';
                    },  
                    'can_scratch' => [
                        'type' => 'checkbox',
                        'options' => [
                            'disabled' => true
                        ]
                    ],
                ],
                'gates' => [
                    'view' => 'customer_show',
                    'edit' => 'customer_edit',
                    'delete' => 'customer_delete'
                ],
                'crudRoutePart' => 'customers'
            ];

            $handler = new DataTableHandler(new Customer(), $config);
            return $handler->handle($request);
        }

        return view('admin.customer.customers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customer.customers.create', compact('users'));
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
            $this->mediaHandler->handleMediaUpload($user, 'photo', $request->input('photo'));
        }

        return redirect()->route('admin.customers.index');
    }

    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        $customer->load('user');
        $user = $customer->user;

        return view('admin.customer.customers.edit', compact('customer', 'user'));
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
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                $this->mediaHandler->handleMediaUpload($user, 'photo', $request->input('photo'));
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

        return view('admin.customer.customers.show', compact('customer','user'));
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
