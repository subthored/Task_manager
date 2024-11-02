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
        $labels = Label::query()->paginate(15);
        return view('labels.index', compact('labels'));
    }

    public function create(Request $request)
    {
        return view('labels.create', ['label' => new Label()]);
    }

    public function store(LabelRequest $request)
    {
        $this->saveLabel(new Label(), $request);
        flash(__('Метка успешно создана'))->success();
        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(LabelRequest $request, Label $label)
    {
        $this->saveLabel($label, $request);
        flash(__('Метка успешно обновлена'))->success();
        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        try {
            $label->delete();
            flash(__('Метка успешно удалена'))->success();
        } catch (\Exception $e) {
            flash(__('Не удалось удалить метку'))->error();
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
