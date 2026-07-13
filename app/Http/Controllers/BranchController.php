<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing.
     */
    public function index(Request $request)
    {
        $query = Branch::with('company');
        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }
        // Company Filter
        if ($request->filled('company')) {
            $query->where('company_id', $request->company);
        }
        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $branches = $query->latest()->paginate(10);
        $companies = Company::where('status', 'active')->get();
        return view('branch.index', compact(
            'branches',
            'companies'
        ));
    }

    /**
     * Show create form
     */
    public function create()    {
        $companies = Company::where('status', 'active')->get();
        return view('branch.create', compact('companies'));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name'       => 'required|max:255',
            'code'       => 'required|unique:branches',
            'email'      => 'nullable|email',
        ]);

        Branch::create($request->all());

        return redirect()
            ->route('branch.index')
            ->with('success', 'Branch created successfully.');
    }

    /**
     * Edit
     */
    public function edit(Branch $branch)
    {
        $companies = Company::where('status', 'active')->get();
        return view('branch.edit', compact('branch','companies'));
    }

    /**
     * Update
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name'       => 'required|max:255',
            'code'       => 'required|unique:branches,code,' . $branch->id,
            'email'      => 'nullable|email',
        ]);
        $branch->update($request->all());
        return redirect()->route('branch.index')->with('success', 'Branch updated successfully.');
    }

    /**
     * Delete
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->back()->with('success', 'Branch deleted successfully.');
    }
}