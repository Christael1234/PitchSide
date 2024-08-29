<?php

namespace App\Http\Controllers;
use carbon\carbon;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Post;

class ContactController extends Controller
{
    // Display a listing of the contacts
    
        public function index(Request $request)
        {
            // Fetch contacts from database
            $query = Contact::query();
    
            // Sorting logic
            if ($request->has('sort')) {
                if ($request->sort == 'name') {
                    $query->orderBy('name');
                } elseif ($request->sort == 'created_at') {
                    $query->orderBy('created_at', 'desc');
                }
            }
    
            $contacts = $query->get();
    
            return view('admin.messages', compact('contacts'));
        }

        
    
        public function index2(Request $request)
        {
            // Fetch contacts from database
            $query = Contact::query();
    
            // Sorting logic
            if ($request->has('sort')) {
                if ($request->sort == 'name') {
                    $query->orderBy('name');
                } elseif ($request->sort == 'created_at') {
                    $query->orderBy('created_at', 'desc');
                }
            }
    
            $contacts = $query->get();


            $posts = Post::withCount('comments')
                 ->orderByDesc('comments_count')
                 ->get();

                 $totalContactsToday = Contact::whereDate('created_at', Carbon::today())->count();
                 
                  // Fetch total number of contacts received yesterday
    $totalContactsYesterday = Contact::whereDate('created_at', Carbon::yesterday())->count();

    // Calculate percentage increase
    if ($totalContactsYesterday > 0) {
        $percentageIncrease = (($totalContactsToday - $totalContactsYesterday) / $totalContactsYesterday) * 100;
    } else {
        $percentageIncrease = $totalContactsToday > 0 ? 100 : 0;
    }

return view('admin.dashboard', compact('contacts', 'totalContactsToday', 'percentageIncrease'), ['posts' => $posts]);
        }

        
        

    // Show the form for creating a new contact
    public function create()
    {
        return view('user.contact');
    }

    // Store a newly created contact in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->route('user.contact')->with('success', 'Message sent successfully.');
    }

    // // Display the specified contact
    // public function show(Contact $contact)
    // {
    //     return view('contacts.show', compact('contact'));
    // }

    // // Show the form for editing the specified contact
    // public function edit(Contact $contact)
    // {
    //     return view('contacts.edit', compact('contact'));
    // }

    // Update the specified contact in storage
   

    // Remove the specified contact from storage
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Message deleted successfully.');
    }
}
