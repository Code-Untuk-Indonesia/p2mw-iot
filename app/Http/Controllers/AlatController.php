<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\UserApp;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('userApp')->orderBy('created_at', 'desc')->simplePaginate(5);
        $users = UserApp::all();
        return view('admin.alat-management', compact('alats', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'userapps_id' => 'required|exists:user_apps,UniqueID',
            'kodealat' => 'required|unique:alats,kodealat',
        ]);

        Alat::create([
            'kodealat' => $request->kodealat,
            'userapps_id' => $request->userapps_id,
        ]);

        return redirect()->route('alats.index')->with('success', 'Alat created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'userapps_id' => 'required|exists:user_apps,UniqueID',
            'kodealat' => 'required|unique:alats,kodealat,' . $id,
        ]);

        $alat = Alat::findOrFail($id);
        $alat->update([
            'kodealat' => $request->kodealat,
            'userapps_id' => $request->userapps_id,
        ]);

        return redirect()->route('alats.index')->with('success', 'Alat updated successfully.');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('alats.index')->with('success', 'Alat deleted successfully.');
    }
}
