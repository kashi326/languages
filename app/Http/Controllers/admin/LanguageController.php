<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Language;
use Illuminate\Support\Facades\Storage;

class LanguageController extends Controller
{
    public function index()
    {
        $per_page = request()->has('per_page') ? request()->get('per_page') : 10;
        $langs = Language::paginate($per_page);
        return view('admin.languages.index')->with('langs', $langs);
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|min: 2|max: 255",
        ]);
        $lang = new Language;
        $lang->name = $request->name;
        $lang->description = $request->description;
        //storing image
        if ($request->has('avatar')) {
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/lang_images/', $name);
            $image_path = '/lang_images/' . $name;
            $lang->avatar = $image_path;
        }
        $lang->code = $request->code;
        $lang->save();
        flash("Language created successfully.")->success();
        return redirect()->route('admin.lang.index');
    }

    public function edit(Language $lang)
    {
        return view('admin.languages.edit')->with('lang', $lang);
    }

    public function update(Request $request, Language $lang)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|min: 2|max: 255",
        ]);
        $validator->sometimes('image', "mimes:jpg,jpeg,png,svg,gif", function ($input) {
            return $input->image != null ? true : false;
        });
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else if ($request->hasFile('avatar')) {
            $lang->name = $request->name;
            $lang->description = $request->description;
            if ($request->has('avatar')) {
                $image = $request->file('avatar');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/lang_images/', $name);
                $image_path = '/lang_images/' . $name;
                if (file_exists(public_path($lang->avatar)) && $lang->avatar != null) {
                    unlink(public_path($lang->avatar));
                }
                $lang->avatar = $image_path;
            }
            $lang->code = $request->code;
            $lang->save();
            flash("Language updated successfully")->warning();
            return redirect()->route('admin.lang.index');
        }
    }

    public function destroy(Language $lang)
    {
        $lang->delete();
        flash("Language deleted successfully")->error();
        return redirect()->route('admin.lang.index');
    }
}
