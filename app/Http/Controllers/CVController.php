<?php

namespace App\Http\Controllers;

use App\Http\Requests\CVStoreRequest;
use App\Models\CV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('cv.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CVStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CVStoreRequest $request)
    {
        $validated = $request->validated();

        $cv = Auth::user()->cv()->create();

        if ($cv) {
            $work = $this->incrementOrder($validated['work']);
            $cv->workExperiance()->createMany($work);

            $education = $this->incrementOrder($validated['education']);
            $cv->education()->createMany($education);

            return redirect()->route('cv.show', $cv);
        } else {
            return redirect()->route('cv.create')->with('error', 'Something went wrong')->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CV $cv
     * @return \Illuminate\Http\Response
     */
    public function show(CV $cv)
    {
        $user = Auth::user();
        return view('cv.show', compact('cv', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CV $cv
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        return view('cv.edit', [
            'cv' => CV::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\CV $cV
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CV $cV)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CV $cV
     * @return \Illuminate\Http\Response
     */
    public function destroy(CV $cV)
    {
        //
    }


    private function incrementOrder($array)
    {

        foreach ($array as $key => $value) {
            $array[$key]['order'] = $key;
        }
        return $array;
    }
}
