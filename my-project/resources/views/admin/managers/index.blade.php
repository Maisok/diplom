@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Заголовок -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800">Управление менеджерами</h2>
        </div>

        <!-- Сообщения об успехе -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-6 mt-4 rounded" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="p-6">
            <!-- Форма добавления нового менеджера -->
            <div class="mb-8 p-6 bg-gray-50 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Добавить нового менеджера</h3>
                <form method="POST" action="{{ route('admin.managers.store') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                            <input type="text" id="name" name="name" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
                            <input type="text" id="phone" name="phone" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
                            <input type="password" id="password" name="password" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Подтверждение</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                        Добавить менеджера
                    </button>
                </form>
            </div>

            <!-- Список менеджеров -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Список менеджеров</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Пароль</th>
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
                                        class="edit-field hidden mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="manager-email block text-sm text-gray-500">{{ $manager->email }}</span>
                                    <input type="email" name="email" value="{{ $manager->email }}"
                                        class="edit-field hidden mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="manager-phone block text-sm text-gray-500">{{ $manager->phone }}</span>
                                    <input type="text" name="phone" value="{{ $manager->phone }}" id="phone2"
                                        class="edit-field hidden mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="password" name="password"
                                           class="edit-field hidden mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="view-mode flex space-x-2">
                                        <button class="edit-btn px-3 py-1 bg-yellow-100 text-yellow-800 rounded-md hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                            Редактировать
                                        </button>
                                        <form action="{{ route('admin.managers.destroy', $manager) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Вы уверены?')"
                                                class="px-3 py-1 bg-red-100 text-red-800 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                Удалить
                                            </button>
                                        </form>
                                    </div>
                                    <div class="edit-mode hidden flex space-x-2">
                                        <button class="save-btn px-3 py-1 bg-green-100 text-green-800 rounded-md hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                                            Сохранить
                                        </button>
                                        <button class="cancel-btn px-3 py-1 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
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
                password: row.querySelector('input[name="password"]').value || undefined,
                password_confirmation: row.querySelector('input[name="password_confirmation"]').value || undefined,
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
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
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