<div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- <livewire:contact-create :contacts="$contacts"></livewire:contact-create> --}}
    {{-- <livewire:contact-create> --}}

    @if ($statusUpdate)
        <livewire:contact-update>
    @else
        <livewire:contact-create>
    @endif

    <hr>
    
    <div class="row">
        <div class="col">
            <select wire:model="paginate" name="" id="" class="form-control form-control-sm w-auto">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>
        <div class="col">
            <input wire:model="search" type="text" class="form-control form-control-sm" placeholder="Search">
        </div>
    </div>
    
    <hr>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0; ?>
            @foreach ($contacts as $contact)
            <?php $no++; ?>
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>
                        <button wire:click="getContact({{ $contact->id }})" class="btn btn-sm btn-info text-white">Edit</button>
                        <button wire:click="destroy({{ $contact->id }})" class="btn btn-sm btn-danger text-white">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
</div>
