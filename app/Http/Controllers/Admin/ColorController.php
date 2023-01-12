<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request)
    {
        $validatedDate = $request->validated();
        $validatedDate['status'] = $request->status == true ? '1' : '0';
        Color::create($validatedDate);

        return redirect('admin/colors')->with(
            'message',
            'Color Added Successfully'
        );
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(ColorFormRequest $request, $color_id)
    {
        $validatedDate = $request->validated();
        $validatedDate['status'] = $request->status == true ? '1' : '0';
        Color::find($color_id)->update($validatedDate);

        return redirect('admin/colors')->with(
            'message',
            'Color Updated Successfully'
        );
    }

    public function destroy($color_id)
    {
        $color = Color::findOrFail($color_id);
        $color->delete();
        return redirect('admin/colors')->with(
            'message',
            'Color Deleted Successfully'
        );
    }
}
