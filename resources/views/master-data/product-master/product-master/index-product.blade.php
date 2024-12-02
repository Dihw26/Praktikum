<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>


 
  <div class="container p-4 mx-auto">f
    <div class="overflow-x-auto">
      <a href="{{ route('product-create')}}">
      <button class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
            Add product data
        </button>
    </a>
      <table class="min-w-full border border-collapse border-gray-200">
        <thead>
          <tr class="bg-gray-100">
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Product Name</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Unit</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Type</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">information</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">qty</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">producer</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            <td class="bg-white">
              <td class="border border border-gray-200 px-4 py2">{{ $product->id}}</td>
              <a href="border border border-gray-200 px-4 py-2 hover:text-blue-500 hover:underline">
                 {{ $product->product_name}}
                 </a>
              </td>
              <td class="border-gray-200 px-4 py-2">{{ $product->unit }}</td>
              <td class="border-gray-200 px-4 py-2">{{ $product->type }}</td>
              <td class="border border-gray-200 px-4 py-2">{{ $product->information }}</td>
              <td class="bborder border-gray-200 px-4 py-2">{{ $product->qty }}</td>
              <td class="border border-gray-200 px-4 py-2">{{ $product->producer}}</td>
              <td class="border border-gray-200 px-4 py-2">
                {{ $product->supplier->supplier_name ??
                '-'}} </td>
                <a href="{{ route('product-edit', $product->id) }}" 
                   class="px-2 text-blue-600 hover:text-blue-800">Edit</a>
                <button class="px-2 text-red-600 hover:text-red-800" 
                   onclick="confirmDelete('{{ route('product-delete', $product->id) }}')">Hapus
                  </button>
              </td>
            </tr>
            @empty
              <p class="mb-4 text-center text-2xl font-bold text-red-600">No products found</p>
          @endforelse
          <!-- Tambahkan baris lainnya sesuai kebutuhan -->
        </tbody>
      </table>
      <div class="mt-4">
        {{ $product->appends(['search' => request('search')])->links()}}
      </div>
    </div>
  </div>


  <script>
    function confirmDelete(id, deleteUrl) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                // Jika user mengonfirmasi, kita dapat membuat form dan mengirimkan permintaan delete
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
   
                // Tambahkan CSRF token
                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);
   
                // Tambahkan method spoofing untuk DELETE (karena HTML form hanya mendukung GET dan POST)
                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
   
                // Tambahkan form ke body dan submit
                document.body.appendChild(form);
                form.submit();
            }
        }
  </script>




</x-app-layout>
