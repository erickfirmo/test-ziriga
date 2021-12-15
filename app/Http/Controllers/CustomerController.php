<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DataTables;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {

            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|unique:cutomers',
                'dob' => 'nullable|digits:10',
                #'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'min:6',
            ]);

            $data = $request->all();

            $model = $this->customer->create($data);

            return response()->json($model, 200);
            
        } catch (\Exception $e) {
            if(env('APP_DEBUG'))
            {
                return response($e->getMessage(), 500)
                    ->header('Content-Type', 'text/plain');
            }
            return response('Ocorreu um erro ao criar usuário!', 500)
                    ->header('Content-Type', 'text/plain');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
                    ->header('Content-Type', 'text/plain');

        } catch (\Exception $e) {
            if(env('APP_DEBUG')) {
                return response($e->getMessage(), 500)
                    ->header('Content-Type', 'text/plain');
            }
            return response('Ocorreu um erro ao deletar usuário!', 500)
                    ->header('Content-Type', 'text/plain');
        }
    }
}
