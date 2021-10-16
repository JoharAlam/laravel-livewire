<div class="card">
    <div class="card-header d-flex justify-content-between"><div class="pt-2">{{ __('USER CRUD') }}</div> <button wire:click="create()" class="btn btn-primary">Create</button></div>

    <div class="card-body">

        <!-- Massages -->
        @include('layouts.messages')
        <!-- Messages End -->

        @if($updateMode == true)
            @include('livewire.update')
        @else
            @include('livewire.create')
        @endif

        <br><br>
        <div class="form-group">
            <input class="form-control" wire:model="search" type="text" placeholder="Search User" autofocus />
        </div>
        <table id="myTable" class="table table-striped" style="margin-top:20px;">
            <thead class="bg-light">
                <tr>
                    <td>NO</td>
                    <td>NAME</td>
                    <td>EMAIL</td>
                    <td>ACTION</td>
                </tr>
            </thead>
            @if(count($data) >0)
                <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>
                                    <button wire:click="edit({{$row->id}})" class="btn btn-sm btn-outline-danger py-0">Edit</button> | 
                                    <button wire:click="destroy({{$row->id}})" class="btn btn-sm btn-outline-danger py-0">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            @endif
        </table>

            @if(count($data) <= 0)
                <div class="text-center">No data available against search</div>
            @endif
    </div>
</div>
