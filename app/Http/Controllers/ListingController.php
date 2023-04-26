<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter
            (\request(['tag', 'search']))->paginate(6),
        ]);
    }
    // Show a single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }


    public function create() {
        return view('listings.create');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required|max:255',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required|url',
            'email' => 'required|email',
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);


        return redirect('/')->with('message', 'The listing was created successfully');
    }
    // Show a form to create a new listing
    public function edit(Listing $listing) {
        return view('listings.edit', [
            'listing' => $listing,
        ]);
    }

    public function update(Request $request, Listing $listing) {
        // Make sure logged in user is owner of listing
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $formFields = $request->validate([
            'title' => 'required|max:255',
            'company' => ['required', Rule::unique('listings', 'company')->ignore($listing->id)],
            'location' => 'required',
            'website' => 'required|url',
            'email' => 'required|email',
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'The listing was updated successfully');
    }

    public function destroy(Listing $listing) {
        // Make sure logged in user is owner of listing
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $listing->delete();
        return redirect('/')->with('message', 'The listing was deleted successfully');
    }

    public function manage() {
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->paginate(6),
        ]);
    }
}
