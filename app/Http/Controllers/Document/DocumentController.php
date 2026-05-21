<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::with(['category', 'uploader']);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $documents  = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('document.index', compact('documents', 'categories'));
    }

    public function create()
    {
        // Only admin and staff can upload
        if (Auth::user()->isViewer()) {
            abort(403, 'You do not have permission to upload documents.');
        }

        $categories = Category::all();
        return view('document.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->isViewer()) {
            abort(403, 'You do not have permission to upload documents.');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'file'        => 'required|file|mimes:pdf|max:10240',
        ]);

        $path = $request->file('file')->store('documents', 'public');

        $document = Document::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'file_path'   => $path,
            'uploaded_by' => Auth::id(),
        ]);

        ActivityLog::create([
            'user_id'     => Auth::id(),
            'document_id' => $document->id,
            'action'      => 'upload',
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Document uploaded successfully.');
    }

    public function edit(Document $document)
    {
        // Viewer cannot edit
        if (Auth::user()->isViewer()) {
            abort(403, 'You do not have permission to edit documents.');
        }

        // Staff can only edit their own documents
        if (Auth::user()->isStaff() && $document->uploaded_by !== Auth::id()) {
            abort(403, 'You can only edit documents that you uploaded.');
        }

        $categories = Category::all();
        return view('document.edit', compact('document', 'categories'));
    }

    public function update(Request $request, Document $document)
    {
        if (Auth::user()->isViewer()) {
            abort(403, 'You do not have permission to edit documents.');
        }

        if (Auth::user()->isStaff() && $document->uploaded_by !== Auth::id()) {
            abort(403, 'You can only edit documents that you uploaded.');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'file'        => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('file')) {
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $data['file_path'] = $request->file('file')->store('documents', 'public');
        }

        $document->update($data);

        ActivityLog::create([
            'user_id'     => Auth::id(),
            'document_id' => $document->id,
            'action'      => 'edit',
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        // Only admin can delete
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can delete documents.');
        }

        $docTitle = $document->title;

        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        ActivityLog::create([
            'user_id'     => Auth::id(),
            'document_id' => null,
            'action'      => "delete ($docTitle)",
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Document deleted successfully.');
    }

    public function preview(Document $document)
    {
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404);
        }

        return response()->file(storage_path('app/public/' . $document->file_path));
    }

    public function download(Document $document)
    {
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404);
        }

        ActivityLog::create([
            'user_id'     => Auth::id(),
            'document_id' => $document->id,
            'action'      => 'download',
        ]);

        return response()->download(storage_path('app/public/' . $document->file_path));
    }
}
