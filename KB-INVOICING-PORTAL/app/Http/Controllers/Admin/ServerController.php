<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Server;

class ServerController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Server::all())
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.servers.edit', $row->id);

                    // Update Delete Button (Remove href, use data-url attribute instead)
                    // $btn = '<a  data-id="' . $row->id . '" class="edit btn btn-primary btn-sm">';
                    $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">';
                    $btn .= '<i class="fas fa-edit"></i>';
                    $btn .= '</a>';

                    $btn .= ' <a href="#" data-id="' . $row->id . '" data-url="' . route('admin.users.destroy', $row->id) . '" class="delete btn btn-danger btn-sm">';
                    $btn .= '<i class="fas fa-trash-alt"></i>';
                    $btn .= '</a>';

                    return $btn;
                })
                ->make(true);
        }

        return view('admin.servers.index');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $server = Server::create($request->only(['name', 'type']));

        return response()->json(['message' => 'Server created successfully!', 'data' => $server]);
    }

    public function create()
    {
        return view('admin.servers.create');
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $server = Server::findOrFail($id);
        return view('admin.servers.edit', compact('server'));
        // return response()->json($server);
    }

    // Update server data
    public function update(Request $request, $id)
    {
        $server = Server::findOrFail($id);
        $server->update($request->all());

        return response()->json(['success' => true, 'message' => 'Server updated successfully']);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $server = Server::findOrFail($id);
        $server->delete();

        return response()->json(['message' => 'Server deleted successfully!']);
    }

}
