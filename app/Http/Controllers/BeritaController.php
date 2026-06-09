<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin_berita.index', compact('beritas'));
    }

    public function showPublic($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $other_news = Berita::where('id', '!=', $berita->id)
            ->where('is_published', true)
            ->latest()
            ->take(5)
            ->get();
            
        return view('berita.show', compact('berita', 'other_news'));
    }

    public function create()
    {
        return view('admin_berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'source_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->title) . '-' . time();
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('berita', 'public');
            $data['image_path'] = $path;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $beritum)
    {
        return view('admin_berita.edit', ['berita' => $beritum]);
    }

    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'source_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        if ($request->title !== $beritum->title) {
            $data['slug'] = Str::slug($request->title) . '-' . time();
        }
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            if ($beritum->image_path) {
                Storage::disk('public')->delete($beritum->image_path);
            }
            $path = $request->file('image')->store('berita', 'public');
            $data['image_path'] = $path;
        }

        $beritum->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->image_path) {
            Storage::disk('public')->delete($beritum->image_path);
        }
        $beritum->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
    
            $request->file('upload')->storeAs('public/berita/images', $fileName);
    
            $url = '/storage/berita/images/' . $fileName;
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
        return response()->json(['uploaded'=> 0, 'error' => ['message' => 'Upload failed']]);
    }
}
