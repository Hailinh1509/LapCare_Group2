<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;

class ReviewController extends Controller
{
    // Hiển thị danh sách đánh giá
    public function index(Request $request)
    {
        $search = $request->search;

        $reviews = DanhGia::with(['user', 'sanpham'])
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->whereHas('user', function($q1) use ($search){
                        $q1->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('sanpham', function($q2) use ($search){
                        $q2->where('tensp', 'like', "%$search%");
                    });
                });
            })
            ->orderBy('ngaytao', 'desc')
            ->paginate(10);

        return view('pages.reviews.index', compact('reviews', 'search'));
    }

    // Xoá đánh giá
    public function destroy($id)
    {
        $review = DanhGia::find($id);

        if($review) {
            $review->delete();
            return back()->with('success', 'Đã xoá đánh giá thành công!');
        }

        return back()->with('error', 'Không tìm thấy đánh giá này!');
    }
}
