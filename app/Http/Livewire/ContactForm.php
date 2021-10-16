<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Session;

class ContactForm extends Component
{
    public $data, $name, $email, $password, $selected_id;
    public $updateMode = false;
    public $search ='';

    public function render()
    {
        if($this->search == null) {
            $this->data = User::all();
        } else {
            $this->data = User::where('name', 'LIKE', '%' . $this->search . '%')->orWhere('email', 'LIKE', '%' . $this->search . '%')->get();
        }
        return view('livewire.contact-form');
    }
    private function resetInput()
    {
        $this->password = null;
        $this->name = null;
        $this->email = null;
    }
    public function store()
    {
        $this->validate([
            'name' => 'required|min:5',
            'email' => 'required|email:rfc,dns|unique:contacts'
        ]);
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => \Hash::make($this->password)
        ]);
        $this->resetInput();

        Session::flash('success', 'User Created Successfully');
    }
    public function create()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->updateMode = true;
    }
    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'name' => 'required|min:5',
        ]);

        $user = User::find($this->selected_id);

        if($this->email != $user->email)
        {
            $this->validate([
                'email' => 'required|email:rfc,dns|unique:contacts'
            ]); 
        }

        if ($this->selected_id) {
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => \Hash::make($this->password)
            ]);
            $this->resetInput();
            $this->updateMode = false;

            Session::flash('success', 'User Updated Successfully');
        }
    }
    public function destroy($id)
    {
        if ($id) {
            $user = User::where('id', $id);
            $user->delete();
            Session::flash('success', 'User Deleted Successfully');
        }
    }
}
