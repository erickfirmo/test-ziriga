<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Http\Requests\Customers\UpdateCustomerRequest;
use DataTables;
use Session;

class CustomerController extends Controller
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customer->exists();

        if (!$customers) {
            return redirect()->route('users.create');
        }

        return view('customers.index');
    }

    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        if (!$request->ajax()) {

            return redirect()->route('users.index');

        } else {
            $data = $this->customer->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('users.edit', $row->id).'" class="edit btn btn-info btn-sm">Editar</a> <button href="javascript:void(0)" onclick="submitAction(this)" data-method="DELETE" data-url="'.route('users.destroy', $row->id).'" class="delete btn btn-danger btn-sm">Excluir</a>';
                    return $actionBtn;
                })
                ->addColumn('date', function($row) {
                    $formatedDate = $row->formatedDate();
                    return $formatedDate;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Customers\StoreCustomerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        try {

            $data = $request->validated();

            $response = $this->customer->create($data);

            Session::flash('success', 'Usuário criado com sucesso!');

            return response()->json($response, 200)
                ->header('Content-Type', 'application/json');

            
        } catch (\Exception $e) {
            if (env('APP_DEBUG'))
            {
                return response()->json(['message' => $e->getMessage()], 500)
                    >header('Content-Type', 'application/json');
            }

            return response()->json(['message' => 'Ocorreu um erro ao criar usuário'], 500)
                ->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('users.edit', compact($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $customer = $this->customer->findOrFail($id);
        } catch (\Exception $e) {
            if(env('APP_DEBUG')) {
                Session::flash('error', $e->getMessage());
                return redirect()->back();
            }
            Session::flash('error', 'Usuário não encontrado!');
            return redirect()->back();
        }

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        try {
            $data = $request->validated();

            $customer = $this->customer->findOrFail($id);

            $customer->update($data);

            Session::flash('success', 'Usuário atualizado com sucesso!');

            return response()->json($customer, 200)
                ->header('Content-Type', 'application/json');

        } catch (\Exception $e) {
            if (env('APP_DEBUG'))
            {
                return response()->json(['message' => $e->getMessage()], 500)
                    >header('Content-Type', 'application/json');
            }

            return response()->json(['message' => 'Ocorreu um erro ao atualizar usuário'], 500)
                ->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $customer = $this->customer->findOrFail($id);
            $customer->delete();

            return response('Usuário deletado com sucesso!', 200)
                ->header('Content-Type', 'application/json');

        } catch (\Exception $e) {
            if(env('APP_DEBUG')) {
                return response($e->getMessage(), 500)
                    ->header('Content-Type', 'application/json');
            }
            return response('Ocorreu um erro ao deletar usuário!', 500)
                ->header('Content-Type', 'application/json');
        }
    }
}
