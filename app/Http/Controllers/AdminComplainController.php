<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;

class AdminComplainController extends Controller
{
    public function index(Request $request)
    {
        $sort['column'] = match ($request->get('sortBy')) {
            'post_id' => 'post_id',
            'created_at' => 'created_at',
            default => 'id',
        };

        $sort['direction'] = match ($request->get('sortDir')) {
            'asc' => 'ASC',
            default => 'DESC'
        };

        return view('admin.complain.index',
            ['title' => 'complains', 'complains' => Complain::query()
                ->orderBy($sort['column'], $sort['direction'])
                ->paginate(20)
                ->withQueryString(),
                'sort' => $sort]);
    }

    public function destroy($id) {
        $complain = Complain::find($id);

        if(!$complain) {
            return back()->with('error', __('Complain not found'));
        }
        $complain->delete();

        return back()->with('success', __('Complain has been deleted'));
    }

    public function markReviewed($id) {
        $complain = Complain::find($id);

        if(!$complain) {
            return back()->with('error', __('Complain not found'));
        }

        $complain->is_reviewed = true;
        $complain->save();

        return back()->with('success', __('Complain has been marked as reviewed'));
    }

    public function markReviewedAll() {
        $complains = Complain::where('is_reviewed', false);

        $complains->update(['is_reviewed' => true]);

        return back()->with('success', __('All complains have been marked as reviewed'));
    }
}
