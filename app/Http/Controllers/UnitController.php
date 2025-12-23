<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Direktorat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isSuperAdmin()) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $units = Unit::with('direktorat')->latest()->paginate(15);
        $direktorats = Direktorat::all();
        return view('units.index', compact('units', 'direktorats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:units',
            'direktorat_id' => 'required|exists:direktorats,id',
            'is_active' => 'boolean'
        ]);

        Unit::create([
            'name' => $request->name,
            'direktorat_id' => $request->direktorat_id,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->back()->with('success', 'Unit kerja berhasil ditambahkan.');
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:units,name,' . $unit->id,
            'direktorat_id' => 'required|exists:direktorats,id',
            'is_active' => 'boolean'
        ]);

        $unit->update([
            'name' => $request->name,
            'direktorat_id' => $request->direktorat_id,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->back()->with('success', 'Unit kerja berhasil diperbarui.');
    }

    public function destroy(Unit $unit)
    {
        if ($unit->sops()->count() > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus unit yang memiliki SOP.');
        }

        $unit->delete();
        return redirect()->back()->with('success', 'Unit kerja berhasil dihapus.');
    }
}
