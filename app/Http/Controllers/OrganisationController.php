<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\Organisation\StoreRequest;
use App\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_superadmin) {
            $organisations = Organisation::orderBy('name', 'asc')->get();
            return view('organisations.index', compact('organisations'));
        }

        $organisations = auth()->user()->manageableOrganisations()->orderBy('name', 'asc')->get();

        return view('organisations.index', compact('organisations'));
    }

    public function create()
    {
        return view('organisations.create');
    }

    public function store(StoreRequest $request)
    {
        $attributes = $request->validated();
        $organisation = Organisation::create($attributes);

        $user = auth()->user();

        if(!$user->is_superadmin) {
            $organisation->users()->save($user, ['type' => UserType::Administrator]);
        }

        return redirect(route('organisations.index'));
    }

    public function show(Organisation $organisation)
    {
        return view('organisations.show', compact('organisation'));
    }

    public function edit(Organisation $organisation)
    {
        return view('organisations.edit', compact('organisation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Organisation $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organisation $organisation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Organisation $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organisation $organisation)
    {
        //
    }
}
