<?php

namespace App\Http\Controllers;

use App\Events\SendCodeEvent;
use App\Models\Code;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;


class CodeController extends Controller
{
    public function create(Code $code = null): View
    {
        Gate::authorize('create', Code::class);
        $codes = Code::latest()->take(20)->get();

        return view('code.create', compact('code', 'codes'));
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', Code::class);
        if (empty($request->input('id'))) {
            $code = auth()->user()->codes()->create(
                [
                    'title' => $request->input('title'),
                    'code' => $request->input('code')
                ]);
        } else {
            $code = Code::find($request->input('id'));
        }

        event(new SendCodeEvent($code->code));

        return to_route('code.create', $code);
    }

    public function show(): View
    {
        Gate::authorize('viewAny', Code::class);

        return view('code.show');
    }
}
