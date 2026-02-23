@extends('layouts.admin')
@section('title', 'Create Product')

@section('content')
  <div class="flex items-center gap-3">
    <a href="{{ route('admin.products.index') }}" class="rounded-lg p-2 text-gray-500 transition-colors hover:bg-gray-100">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </a>
    <div>
      <h1 class="text-2xl font-bold text-gray-900">Create Product</h1>
      <p class="mt-0.5 text-sm text-gray-500">Add a new product to your catalog</p>
    </div>
  </div>

  <div class="mt-8 mx-auto max-w-2xl">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
      class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
      @csrf
      <div class="space-y-5">
        <x-form-input name="name" label="Product Name" placeholder="e.g. Wireless Headphones" required />

        <x-form-input name="description" type="textarea" label="Description" placeholder="Describe your product..."
          required />

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
          <x-form-input name="price" type="number" label="Price (Rupiah)" placeholder="0" required min="0" />
          <x-form-input name="stock" type="number" label="Stock" placeholder="0" required min="0" />
        </div>

        <div>
          <label for="category" class="mb-1.5 block text-sm font-medium text-gray-700">Category <span
              class="text-red-500">*</span></label>
          <input type="text" name="category" id="category" value="{{ old('category') }}" list="categories" required
            placeholder="Select or type category"
            class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-3 text-sm text-gray-800 placeholder-gray-400 transition-all focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100">
          <datalist id="categories">
            @foreach ($categories as $cat)
              <option value="{{ $cat }}">
            @endforeach
          </datalist>
          @error('category')
            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Image Upload --}}
        <div>
          <label class="mb-1.5 block text-sm font-medium text-gray-700">Product Image</label>
          <div x-data="{ preview: null }" class="space-y-3">
            <div class="flex items-center justify-center w-full">
              <label
                class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50/50 hover:bg-gray-50 transition-colors">
                <template x-if="preview">
                  <img :src="preview" class="h-full w-full object-contain rounded-2xl p-2">
                </template>
                <template x-if="!preview">
                  <div class="flex flex-col items-center justify-center py-5">
                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="mt-2 text-xs text-gray-500">Click to upload image</p>
                    <p class="text-xs text-gray-400">PNG, JPG, WEBP up to 2MB</p>
                  </div>
                </template>
                <input type="file" name="image" class="hidden" accept="image/*"
                  @change="const file = $event.target.files[0]; if(file) { const reader = new FileReader(); reader.onload = e => preview = e.target.result; reader.readAsDataURL(file); }">
              </label>
            </div>
          </div>
          @error('image')
            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="mt-8 flex gap-3">
        <button type="submit"
          class="flex-1 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:shadow-xl hover:-translate-y-0.5">
          Create Product
        </button>
        <a href="{{ route('admin.products.index') }}"
          class="rounded-xl bg-gray-100 px-6 py-3 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-200">
          Cancel
        </a>
      </div>
    </form>
  </div>
@endsection
