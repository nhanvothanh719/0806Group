<?php

namespace App\Http\Livewire;

use Cog\Laravel\Love\Reacter\Facades\Reacter;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class ReactComponent extends Component
{
    public Model $model;
    public $LikeCount;
    public $DislikeCount;
    public $isLikeByUser;
    public $isDislikeByUser;

    public function render()
    {
        return view('livewire.react-component');
    }

    public function mount(){
        $reactantFacade = $this->model->getLoveReactant();
        $likeType = ReactionType::fromName('Like');
        $disLikeType = ReactionType::fromName('Dislike');
        $user = Auth::user();
        $reacter = $user->getLoveReacter();
        $this->LikeCount =  $reactantFacade->getReactionCounterOfType($likeType)->getCount();
        $this->DislikeCount =  $reactantFacade->getReactionCounterOfType($disLikeType)->getCount();
        $this->isLikeByUser = $reactantFacade->isReactedBy($reacter, $likeType);
        $this->isDislikeByUser = $reactantFacade->isReactedBy($reacter, $disLikeType);
    }

    public function like(){
        if(!Auth::check())
            return false;

        $reacterFacade = Auth::user()->viaLoveReacter();

        if(!$this->isLikeByUser){

            if($this->isDislikeByUser) //Remove dislike if already exist
                $this->dislike();

            $reacterFacade->reactTo($this->model, 'Like');
            $this->LikeCount++;
            $this->isLikeByUser = true;
        }else {
            $reacterFacade->unreactTo($this->model, 'Like');
            $this->LikeCount--;
            $this->isLikeByUser = false;
        }     
    }

    public function dislike(){
        if(!Auth::check())
            return false;

        $reacterFacade = Auth::user()->viaLoveReacter();

        if(!$this->isDislikeByUser){

            if($this->isLikeByUser) //Remove like if already exist
                $this->like();

            $reacterFacade->reactTo($this->model, 'Dislike');
            $this->DislikeCount++;
            $this->isDislikeByUser = true;
        }else {
            $reacterFacade->unreactTo($this->model, 'Dislike');
            $this->DislikeCount--;
            $this->isDislikeByUser = false;
        }     
    }
}
