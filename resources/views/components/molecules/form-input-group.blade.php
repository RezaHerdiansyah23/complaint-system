@props(['label', 'name', 'type' => 'text', 'value' => '', 'required' => false])

<div class="mb-4">
    <x-atoms.label :for="$name" :value="$label" />
    <x-atoms.input 
        id="{{ $name }}" 
        type="{{ $type }}" 
        name="{{ $name }}" 
        :value="$value" 
        :required="$required" 
        autocomplete="{{ $name }}" 
    />
    <x-atoms.error :messages="$errors->get($name)" class="mt-2" />
</div>