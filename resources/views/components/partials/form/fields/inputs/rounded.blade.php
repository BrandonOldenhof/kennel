@props(['type' => 'text', 'name', 'value' => old($name)])

<x-partials.form.fields.inputs.base :type="$type" :name="$name" :value="$value" class="rounded-md" />
