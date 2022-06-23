@props(['type' => 'text', 'name', 'value' => old($name)])

<x-partials.form.fields.inputs.base :type="$type" :name="$name" :value="$value" readonly disabled
    class="disabled:bg-gray-100 disabled:text-slate-600" />
