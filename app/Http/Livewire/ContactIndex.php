<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;

    public $statusUpdate = false;
    public $paginate = 5;
    public $search;

    protected $listeners = [
        'contactStored' => 'handleStored',
        'contactUpdated' => 'handleUpdated'
    ];

    protected $updatesQueryString = ['search'];

    protected function mount() {
        $this->search = request()->query('search', $this->search);
    }
    
    public function render()
    {

         return view('livewire.contact-index', [
             'contacts' => $this->search == null ?
                 Contact::latest()->paginate($this->paginate) :
                 Contact::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
         ]);
    }

    public function getContact($id)
    {
        $this->statusUpdate = true;
       $contact = Contact::find($id);
       $this->emit('getContact', $contact);
    }

    public function destroy($id)
    {
        if ($id) {
           $data = Contact::find($id);
           $data->delete();

          session()->flash('error', 'Contact telah berhasil di destroy!');
        }
    }

    public function handleStored($contact)
    {
        // dd($contact);
        session()->flash('message', 'Contact ' . $contact['name'] . ' telah berhasil di stored!');
    }

    public function handleUpdated($contact)
    {
        // dd($contact);
        session()->flash('message', 'Contact ' . $contact['name'] . ' telah berhasil di updated!');
    }
}
