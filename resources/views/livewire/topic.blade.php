<?php
use App\Models\Topic;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Component;

new class extends Component {
    public $topic = "";

    public function mount()
    {
        $this->topic = Topic::first()?->topic;
    }

    public function save() {
        if (Auth::user()->isAdminUser()) {
            DB::table("topics")->delete();
            DB::table("topics")->insert([
                "topic" => $this->topic,
            ]);
        }
    }
}

?>

<div>
@if (Auth::user()->isAdminUser())
    <form>
        <flux:input wire:model="topic" />
        <flux:button wire:click="save"> Save </flux:button>
    </form>
@else
{{ Topic::first()?->topic }}
@endif

</div>

