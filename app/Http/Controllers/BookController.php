<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display the list of available books for reservation.
     * Filters books by category if provided in the request.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Retrieve all categories from the database for the category filter dropdown
        $categories = Category::all();
        
        // Initialize a query for books to allow category filtering
        $query = Book::query();

        // Check if a category filter was applied and add it to the query if so
        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }
        
        // Capture the selected category to pass to the view
        $category = $request->input('category');

        // Fetch books that match the selected category (if provided), excluding reserved books
        $availableBooks = Book::when($category !== 'All Categories', function ($query) use ($category) {
                // Only add category filter if the selected category is not "All Categories"
                return $query->whereHas('category', function ($query) use ($category) {
                    $query->where('name', $category); // Filter by the name of the category
                });
            })
            ->whereNotExists(function ($query) {
                // Exclude books that are currently reserved
                $query->select(DB::raw(1))
                      ->from('reservations')
                      ->whereRaw('reservations.book_id = books.id')
                      ->where('end_date', '>=', now()); // Exclude books with ongoing reservations
            })
            ->get();

        // Return the book listing view, passing the filtered books and category options
        return view('books.index', compact('availableBooks', 'categories', 'category'));
    }

    /**
     * Show the reservation confirmation page for a specific book.
     *
     * @param Book $book
     * @return \Illuminate\View\View
     */
    public function reserve(Book $book)
    {
        // Display the reservation confirmation page for the selected book
        return view('books.reserve', compact('book'));
    }
}
