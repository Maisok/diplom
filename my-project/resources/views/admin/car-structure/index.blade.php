@extends('layouts.admin')

@section('title', 'Структура автомобилей')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Управление автомобильной структурой</h1>
            <p class="mt-2 text-sm text-gray-600">Управление марками, моделями и поколениями автомобилей</p>
        </div>

        <!-- Messages -->
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-700">Обнаружены ошибки:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Search -->
        <div class="mb-8 bg-white shadow-sm rounded-lg p-4">
            <form method="GET" action="{{ route('admin.car-structure.index') }}" class="space-y-4 sm:space-y-0 sm:flex sm:space-x-3">
                <div class="flex-grow">
                    <label for="search" class="sr-only">Поиск</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                               class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2"
                               placeholder="Поиск по маркам, моделям, поколениям...">
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Найти
                    </button>
                    <a href="{{ route('admin.car-structure.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Сбросить
                    </a>
                </div>
            </form>
        </div>

        <!-- Structure Sections Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            
            <!-- Brands Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Марки</h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <!-- Add Form -->
                    <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data" class="mb-6 space-y-4">
                        @csrf
                        <div>
                            <label for="brand_name" class="block text-sm font-medium text-gray-700">Название марки</label>
                            <input type="text" name="name" id="brand_name" placeholder="Название марки" required maxlength="50"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="brand_logo" class="block text-sm font-medium text-gray-700">Логотип</label>
                            <input type="file" name="logo" id="brand_logo"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Добавить марку
                            </button>
                        </div>
                    </form>
                    
                    <!-- List -->
                    <div class="overflow-hidden border border-gray-200 rounded-lg">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($brands as $brand)
                                <li class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between space-x-4">
                                        <div class="flex items-center min-w-0 flex-1">
                                            @if($brand->logo)
                                                <div class="flex-shrink-0 h-10 w-10 mr-3">
                                                    <img class="h-10 w-10 rounded-full object-contain" src="{{ asset('storage/' . $brand->logo) }}" alt="Логотип {{ $brand->name }}">
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $brand->name }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <button onclick="toggleEditForm('brand-{{ $brand->id }}')"
                                                    class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
                                            <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Удалить эту марку?')"
                                                        class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Edit Form -->
                                    <form method="POST" action="{{ route('admin.brands.update', $brand) }}" id="brand-{{ $brand->id }}" enctype="multipart/form-data" class="mt-3 hidden space-y-2">
                                        @csrf @method('PUT')
                                        <div>
                                            <input type="text" name="name" value="{{ $brand->name }}" required maxlength="50"
                                                   class="block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <input type="file" name="logo" class="text-xs flex-1">
                                            <button type="submit" onclick="return confirm('Сохранить изменения?')"
                                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Сохранить
                                            </button>
                                            <button type="button" onclick="toggleEditForm('brand-{{ $brand->id }}')"
                                                    class="inline-flex items-center px-2 py-1 border border-gray-300 text-xs rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Отмена
                                            </button>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $brands->appends([
                            'search' => request('search'),
                            'page_models' => request('page_models'),
                            'page_generations' => request('page_generations')
                        ])->links() }}
                    </div>
                </div>
            </div>

            <!-- Models Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Модели</h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <!-- Add Form -->
                    <form method="POST" action="{{ route('admin.models.store') }}" class="mb-6 space-y-4">
                        @csrf
                        <div>
                            <label for="model_brand" class="block text-sm font-medium text-gray-700">Марка</label>
                            <select name="brand_id" id="model_brand" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                @foreach (\App\Models\Brand::all() as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="model_name" class="block text-sm font-medium text-gray-700">Название модели</label>
                            <input type="text" name="name" id="model_name" placeholder="Название модели" required maxlength="50"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Добавить модель
                            </button>
                        </div>
                    </form>
                    
                    <!-- List -->
                    <div class="overflow-hidden border border-gray-200 rounded-lg">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($models as $model)
                                <li class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between space-x-4">
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ optional($model->brand)->name }} — {{ $model->name }}</p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <button onclick="toggleEditForm('model-{{ $model->id }}')"
                                                    class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
                                            <form method="POST" action="{{ route('admin.models.destroy', $model) }}">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Удалить эту модель?')"
                                                        class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Edit Form -->
                                    <form method="POST" action="{{ route('admin.models.update', $model) }}" id="model-{{ $model->id }}" class="mt-3 hidden space-y-2">
                                        @csrf @method('PUT')
                                        <div>
                                            <select name="brand_id" class="block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                                @foreach (\App\Models\Brand::all() as $b)
                                                    <option value="{{ $b->id }}" {{ $b->id == $model->brand_id ? 'selected' : '' }}>
                                                        {{ $b->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex space-x-2">
                                            <input type="text" name="name" value="{{ $model->name }}" required maxlength="50"
                                                   class="flex-1 block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                            <button type="submit" onclick="return confirm('Сохранить изменения?')"
                                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Сохранить
                                            </button>
                                            <button type="button" onclick="toggleEditForm('model-{{ $model->id }}')"
                                                    class="inline-flex items-center px-2 py-1 border border-gray-300 text-xs rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Отмена
                                            </button>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $models->appends([
                            'search' => request('search'),
                            'page_brands' => request('page_brands'),
                            'page_generations' => request('page_generations')
                        ])->links() }}
                    </div>
                </div>
            </div>

            <!-- Generations Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Поколения</h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <!-- Add Form -->
                    <form method="POST" action="{{ route('admin.generations.store') }}" class="mb-6 space-y-4">
                        @csrf
                        <div>
                            <label for="generation_model" class="block text-sm font-medium text-gray-700">Модель</label>
                            <select name="car_model_id" id="generation_model" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                @foreach (\App\Models\CarModel::with('brand')->get() as $m)
                                    <option value="{{ $m->id }}">
                                        {{ optional($m->brand)->name }} — {{ $m->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="generation_name" class="block text-sm font-medium text-gray-700">Название поколения</label>
                            <input type="text" name="name" id="generation_name" placeholder="Название поколения" required maxlength="50"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="year_from" class="block text-sm font-medium text-gray-700">Год начала</label>
                                <input type="number" name="year_from" id="year_from" placeholder="с" required min="1900" max="{{ date('Y') + 10 }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="year_to" class="block text-sm font-medium text-gray-700">Год окончания</label>
                                <input type="number" name="year_to" id="year_to" placeholder="по" min="1900" max="{{ date('Y') + 10 }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Добавить поколение
                            </button>
                        </div>
                    </form>
                    
                    <!-- List -->
                    <div class="overflow-hidden border border-gray-200 rounded-lg">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($generations as $gen)
                                <li class="px-4 py-4 sm:px-6">
                                    <div class="flex items-start justify-between space-x-4">
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-medium text-gray-900">
                                                <span class="font-semibold">{{ optional($gen->carModel->brand)->name }}</span> 
                                                {{ optional($gen->carModel)->name }}
                                            </p>
                                            <p class="text-sm text-gray-500 mt-1">
                                                {{ $gen->name }} ({{ $gen->year_from }}–{{ $gen->year_to }})
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <button onclick="toggleEditForm('gen-{{ $gen->id }}')"
                                                    class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
                                            <form method="POST" action="{{ route('admin.generations.destroy', $gen) }}">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Удалить это поколение?')"
                                                        class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Edit Form -->
                                    <form method="POST" action="{{ route('admin.generations.update', $gen) }}" id="gen-{{ $gen->id }}" class="mt-3 hidden space-y-2">
                                        @csrf @method('PUT')
                                        <div>
                                            <select name="car_model_id" class="block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                                @foreach (\App\Models\CarModel::with('brand')->get() as $m)
                                                    <option value="{{ $m->id }}" {{ $m->id == $gen->car_model_id ? 'selected' : '' }}>
                                                        {{ optional($m->brand)->name }} — {{ $m->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <input type="text" name="name" value="{{ $gen->name }}" required maxlength="50"
                                                   class="block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        </div>
                                        <div class="grid grid-cols-2 gap-2">
                                            <input type="number" name="year_from" value="{{ $gen->year_from }}" required min="1900" max="{{ date('Y') + 10 }}"
                                                   class="block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                            <input type="number" name="year_to" value="{{ $gen->year_to }}" min="1900" max="{{ date('Y') + 10 }}"
                                                   class="block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="submit" onclick="return confirm('Сохранить изменения?')"
                                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Сохранить
                                            </button>
                                            <button type="button" onclick="toggleEditForm('gen-{{ $gen->id }}')"
                                                    class="inline-flex items-center px-2 py-1 border border-gray-300 text-xs rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Отмена
                                            </button>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $generations->appends([
                            'search' => request('search'),
                            'page_brands' => request('page_brands'),
                            'page_models' => request('page_models')
                        ])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function toggleEditForm(id) {
            const form = document.getElementById(id);
            form.classList.toggle('hidden');
        }
    
        document.addEventListener('DOMContentLoaded', function () {
            // Подтверждение удаления
            document.querySelectorAll("form[action*='destroy']").forEach(form => {
                form.addEventListener('submit', function (e) {
                    const confirmed = confirm('Вы уверены, что хотите удалить этот элемент?');
                    if (!confirmed) e.preventDefault();
                });
            });
        });
    </script>
    
@endsection