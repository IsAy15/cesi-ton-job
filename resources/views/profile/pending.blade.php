<!-- resources/views/pending.blade.php -->
@extends('layouts.home')
@section('title', 'Utilisateurs en attente')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Utilisateurs en attente</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Validation</th>
                </tr>
            </thead>
            <style>
.switch {
  position: relative;
  display: inline-block;
  width: 3rem;
  height: 1.5rem;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 1rem;
  width: 1rem;
  left: 0.25rem;
  bottom: 0.25rem;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: var(--eltcolor);
}

input:focus + .slider {
  box-shadow: 0 0 thin var(--eltcolor);
}

input:checked + .slider:before {
  -webkit-transform: translateX(1.5rem);
  -ms-transform: translateX(1.5rem);
  transform: translateX(1.5rem);
}

/* Rounded sliders */
.slider.round {
  border-radius: 2rem;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
            <tbody>
                @foreach($pendingUsers as $user)
                <tr>
                    <td>{{ $user->lastname }} {{ $user->firstname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" id="{{ $user->id }}">
                            <span class="slider round"></span>
                        </label>
                        <!-- <a href="{{ route('profile.edit', $user->id) }}" class="btn-1"><i class="fa-solid fa-pen-to-square"></i>
                        </a> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        const switchElements = document.querySelectorAll('.switch input');

        switchElements.forEach((switchElement) => {
        
            switchElement.addEventListener('change', async (e) => {
                const userId = e.target.id;
                console.log(userId);
                const response = await fetch(`/profile/update/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: e.target.checked ? 'approved' : 'pending'
                    })
                });
                if (response.ok) {
                    console.log('User status updated');
                    setTimeout(() => {
                        e.target.closest("tr").remove();
                    }, 1000);
                }
            });
        });
    </script>
@endsection
