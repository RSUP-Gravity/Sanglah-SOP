<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $guides = Guide::orderBy('sort_order')->orderBy('created_at')->paginate(10);
        return view('guides.index', compact('guides'));
    }

    /**
     * Display the guides for users (Public Documentation Style).
     */
    public function list(Request $request)
    {
        // Get active guides grouped by chapter
        $chapters = Guide::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('chapter');
            
        // If a specific guide is requested provided via query param or slug, we could show it
        // But for now, just show the list. Ideally, we want /panduan/{slug}.
        
        return view('guides.list', compact('chapters'));
    }

    /**
     * Show specific guide in documentation layout.
     */
    public function showPublic($slug)
    {
        $guide = Guide::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        $chapters = Guide::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('chapter');

        return view('guides.show_public', compact('guide', 'chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Get existing chapters for autocomplete
        $existingChapters = Guide::select('chapter')->distinct()->pluck('chapter');

        return view('guides.create', compact('existingChapters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'chapter' => 'nullable|string|max:255',
            'description' => 'required|string',
            'sections' => 'nullable|array',
            'sections.*.title' => 'required|string|max:255',
            'sections.*.content' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'video_url' => 'nullable|url',
            'sort_order' => 'integer',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        $data['chapter'] = $request->filled('chapter') ? $request->chapter : 'Umum';
        
        // Ensure sections is null or array
        $data['sections'] = $request->input('sections', null);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('guides', 'public');
            $data['image_path'] = $path;
        }

        Guide::create($data);

        return redirect()->route('guides.index')->with('success', 'Panduan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guide $guide)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get existing chapters for autocomplete
        $existingChapters = Guide::select('chapter')->distinct()->pluck('chapter');

        return view('guides.edit', compact('guide', 'existingChapters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guide $guide)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'chapter' => 'nullable|string|max:255',
            'description' => 'required|string',
            'sections' => 'nullable|array',
            'sections.*.title' => 'required|string|max:255',
            'sections.*.content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'sort_order' => 'integer',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');
        $data['chapter'] = $request->filled('chapter') ? $request->chapter : 'Umum';
        $data['sections'] = $request->input('sections', null); // Allow clearing sections
        
        // Update slug if title changed
        if ($guide->title !== $request->title) {
            $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($guide->image_path) {
                Storage::disk('public')->delete($guide->image_path);
            }
            $path = $request->file('image')->store('guides', 'public');
            $data['image_path'] = $path;
        }

        $guide->update($data);

        return redirect()->route('guides.index')->with('success', 'Panduan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guide $guide)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        if ($guide->image_path) {
            Storage::disk('public')->delete($guide->image_path);
        }
        $guide->delete();

        return redirect()->route('guides.index')->with('success', 'Panduan berhasil dihapus.');
    }
    public function toggleStatus(Guide $guide)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Handle GET request gracefully
        if (request()->isMethod('get')) {
            return redirect()->back()->with('error', 'Metode tidak diizinkan. Silakan gunakan tombol yang tersedia.');
        }

        $guide->is_active = !$guide->is_active;
        $guide->save();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Status panduan berhasil diperbarui.',
                'is_active' => $guide->is_active
            ]);
        }

        return redirect()->back()->with('success', 'Status panduan berhasil diperbarui.');
    }
}
