@props([
    'type' => 'text',
    'name',
    'label' => null,
    'value' => '',
    'placeholder' => '',
    'required' => false,
])

<div>
  @if ($label)
    <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-gray-700">{{ $label }}
      @if ($required)
        <span class="text-red-500">*</span>
      @endif
    </label>
  @endif

  @if ($type === 'textarea')
    <textarea name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" rows="4"
      {{ $required ? 'required' : '' }}
      {{ $attributes->merge(['class' => 'w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-3 text-sm text-gray-800 placeholder-gray-400 transition-all focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 ' . ($errors->has($name) ? 'border-red-300 focus:border-red-300 focus:ring-red-100' : '')]) }}>{{ old($name, $value) }}</textarea>
  @else
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
      value="{{ old($name, $value) }}" min="0" placeholder="{{ $placeholder }}"
      {{ $required ? 'required' : '' }}
      {{ $attributes->merge(['class' => 'w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-3 text-sm text-gray-800 placeholder-gray-400 transition-all focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 ' . ($errors->has($name) ? 'border-red-300 focus:border-red-300 focus:ring-red-100' : '')]) }}>
  @endif

  @error($name)
    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
  @enderror
</div>
