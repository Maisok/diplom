@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Управление менеджерами</h1>

        <!-- Уведомления -->
        <div class="space-y-4 mb-6">
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm">
                    <div class="flex items-start">
                        <svg class="h-5 w-5 text-red-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-red-800">Произошли ошибки:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm flex items-start">
                    <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm text-green-700">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm flex items-start">
                    <svg class="h-5 w-5 text-red-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm text-red-700">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <!-- Форма добавления менеджера -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200 mb-6">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-sm sm:text-base font-medium text-gray-700">Добавить нового менеджера</h3>
            </div>
            <div class="p-4 sm:p-6">
                <form method="POST" action="{{ route('admin.managers.store') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Имя</label>
                            <input type="text" id="name" name="name" required
                                class="w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
                            <input type="text" id="phone" name="phone" required
                                class="w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Пароль</label>
                            <input type="password" id="password" name="password" required
                                class="w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Подтверждение</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Добавить менеджера
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Список менеджеров -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-sm sm:text-base font-medium text-gray-700">Список менеджеров</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($managers as $manager)
                        <tr class="hover:bg-gray-50" data-id="{{ $manager->id }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $manager->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="manager-name block text-sm font-medium text-gray-900">{{ $manager->name }}</span>
                                <input type="text" name="name" value="{{ $manager->name }}"
                                    class="edit-field hidden mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="manager-email block text-sm text-gray-500">{{ $manager->email }}</span>
                                <input type="email" name="email" value="{{ $manager->email }}"
                                    class="edit-field hidden mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="manager-phone block text-sm text-gray-500">{{ $manager->phone }}</span>
                                <input type="text" name="phone" value="{{ $manager->phone }}" id="phone2"
                                    class="edit-field hidden mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="view-mode flex space-x-2">
                                    <button class="edit-btn inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                        Редактировать
                                    </button>
                                    <form action="{{ route('admin.managers.destroy', $manager) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Вы уверены?')"
                                            class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                                <div class="edit-mode hidden flex space-x-2">
                                    <button class="save-btn inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Сохранить
                                    </button>
                                    <button class="cancel-btn inline-flex items-center px-3 py-1 border border-gray-300 text-xs font-medium rounded shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Отмена
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Обработка кнопки редактирования
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            
            // Переключаем режимы отображения
            row.querySelectorAll('.manager-name, .manager-email, .manager-phone').forEach(el => {
                el.classList.add('hidden');
            });
            
            row.querySelectorAll('.edit-field').forEach(el => {
                el.classList.remove('hidden');
            });
            
            // Переключаем кнопки
            row.querySelector('.view-mode').classList.add('hidden');
            row.querySelector('.edit-mode').classList.remove('hidden');
        });
    });
    
    // Обработка кнопки отмены
    document.querySelectorAll('.cancel-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            
            // Возвращаем исходные значения
            const name = row.querySelector('.manager-name').textContent;
            const email = row.querySelector('.manager-email').textContent;
            const phone = row.querySelector('.manager-phone').textContent;
            
            row.querySelector('input[name="name"]').value = name;
            row.querySelector('input[name="email"]').value = email;
            row.querySelector('input[name="phone"]').value = phone;
            
            // Переключаем режимы отображения
            row.querySelectorAll('.manager-name, .manager-email, .manager-phone').forEach(el => {
                el.classList.remove('hidden');
            });
            
            row.querySelectorAll('.edit-field').forEach(el => {
                el.classList.add('hidden');
            });
            
            // Переключаем кнопки
            row.querySelector('.view-mode').classList.remove('hidden');
            row.querySelector('.edit-mode').classList.add('hidden');
        });
    });
    
    // Обработка кнопки сохранения
    document.querySelectorAll('.save-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const id = row.getAttribute('data-id');
            
            const data = {
                name: row.querySelector('input[name="name"]').value,
                email: row.querySelector('input[name="email"]').value,
                phone: row.querySelector('input[name="phone"]').value,
                _token: '{{ csrf_token() }}',
                _method: 'PUT'
            };
            
            fetch(`/admin/managers/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Обновляем текстовые значения
                    row.querySelector('.manager-name').textContent = data.manager.name;
                    row.querySelector('.manager-email').textContent = data.manager.email;
                    row.querySelector('.manager-phone').textContent = data.manager.phone;
                    
                    // Показываем уведомление
                    showNotification('Данные менеджера успешно обновлены', 'success');
                    
                    // Возвращаем в режим просмотра
                    row.querySelector('.cancel-btn').click();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Произошла ошибка при обновлении данных', 'error');
            });
        });
    });
    
    // Функция для показа уведомлений
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-md shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Форматирование телефона
    const phoneInput = document.getElementById('phone');
    const phoneInput2 = document.getElementById('phone2');

    if (phoneInput) {
        phoneInput.addEventListener("input", function (e) {
            let input = this.value.replace(/\D/g, '');
            let formatted = '';

            if (input.length > 0) {
                formatted = '8 ';
            }

            if (input.length > 1) {
                formatted += input.substring(1, 4);
            }

            if (input.length > 4) {
                formatted += ' ' + input.substring(4, 7);
            }

            if (input.length > 7) {
                formatted += ' ' + input.substring(7, 9);
            }

            if (input.length > 9) {
                formatted += ' ' + input.substring(9, 11);
            }

            this.value = formatted;
        });
    }

    if (phoneInput2) {
        phoneInput2.addEventListener("input", function (e) {
            let input = this.value.replace(/\D/g, '');
            let formatted = '';

            if (input.length > 0) {
                formatted = '8 ';
            }

            if (input.length > 1) {
                formatted += input.substring(1, 4);
            }

            if (input.length > 4) {
                formatted += ' ' + input.substring(4, 7);
            }

            if (input.length > 7) {
                formatted += ' ' + input.substring(7, 9);
            }

            if (input.length > 9) {
                formatted += ' ' + input.substring(9, 11);
            }

            this.value = formatted;
        });
    }
});
</script>
@endsection