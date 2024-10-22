<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Models\Label;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::all();
        return view('labels.index', compact('labels'));
    }

    public function create(Request $request)
    {
        return view('labels.create', ['label' => new Label()]);
    }

    public function store(LabelRequest $request)
    {
        $this->saveLabel(new Label(), $request);
        flash(__('Label updated successfully'))->success();
        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(LabelRequest $request, Label $label)
    {
        $this->saveLabel($label, $request);
        flash(__('Label updated successfully'))->success();
        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        try {
            $label->delete();
            flash(__('Label removed successfully'))->success();
        } catch (\Exception $e) {
            flash(__('Failed to remove label'))->error();
        }
        return redirect()->route('labels.index');
    }

    private function saveLabel(Label $label, LabelRequest $request)
    {
        $validated = $request->validated();
        $label->fill($validated);
        $label->save();
    }
}
