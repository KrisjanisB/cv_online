<?php

namespace App\Http\Controllers;

use App\Http\Requests\CVStoreRequest;
use App\Models\CV;
use Barryvdh\DomPDF\Facade\Pdf;
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
        return redirect()->route('dashboard');
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
            if (isset($validated['work'])) {
                $work = $this->incrementOrder($validated['work']);
                $cv->work()->createMany($work);
            }

            if (isset($validated['education'])) {
                $education = $this->incrementOrder($validated['education']);
                $cv->education()->createMany($education);
            }


            return redirect()->route('cv.show', $cv)->with('status', __('Action completed successfully'));
        } else {
            return redirect()->route('cv.create')->with('status', 'Something went wrong')->withInput();
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
        if (Auth::check()) {
            $user = Auth::user();
            return view('cv.show', compact('cv', 'user'));
        } else {
            $cv = CV::publicAccessable()->findOrFail($cv->id);
            $user = $cv->user;

            return view('cv.public.show', compact('cv', 'user'));
        }

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
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\CV $cv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CV $cv)
    {


        if ($request->isMethod('patch')) {
            $cv->is_published = !$cv->is_published;
            $cv->is_draft = 0;
            $cv->save();
        } else {

            $this->updateUser($request->only([ 'city', 'country', 'zip','address' ]));

            $cv->work()->delete();

            $array = $this->clearNulls($request->work, 'position');
            if (count($array) > 0) {
                $cv->work()->createMany($this->incrementOrder($array));
            }

            $cv->education()->delete();
            $array = $this->clearNulls($request->education, 'institution');
            if (count($array) > 0) {
                $cv->education()->createMany($this->incrementOrder($array));
            }

        }

        return redirect()->route('cv.show', $cv)->with('status', __('Action completed successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CV $cv
     * @return \Illuminate\Http\Response
     */
    public function destroy(CV $cv)
    {
        $cv->delete();
        return redirect()->route('dashboard')->with('status', __('Action completed successfully'));
    }


    public function print(CV $cv)
    {

        $cv = CV::publicAccessable()->findOrFail($cv->id);
        $user = $cv->user;

        $pdf = PDF::loadView('pdf.print-cv', ['cv' => $cv, 'user' => $user])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'portrait');

        return $pdf->stream('cv.pdf');
    }


    private function incrementOrder($array)
    {

        foreach ($array as $key => $value) {
            $array[$key]['order'] = $key;
        }
        return $array;
    }

    private function clearNulls($array, $needle)
    {
        foreach ($array as $key => $value) {
            if (is_array($value) && $value[$needle] == null) {
                unset($array[$key]);
            }
        }

        return $array;
    }

   // Update user and profile details
    private function updateUser($data)
    {
        $user = Auth::user();

        $user->profile->update([
            'city' => $data['city'],
            'country' => $data['country'],
            'zip' => $data['zip'],
            'address' => $data['address'],
        ]);

    }
}
