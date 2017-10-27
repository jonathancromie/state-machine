<?php

namespace App\Traits;

use SM\Factory\FactoryInterface;

trait Statable
{
    /**
     * @var StateMachine $stateMachine
     */
    protected $stateMachine;
    
    public function stateMachine()
    {
        if (!$this->stateMachine) {
            $this->stateMachine = app(FactoryInterface::class)->get($this, self::SM_CONFIG);
        }
        return $this->stateMachine;
    }

    public function stateIs()
    {
        return $this->stateMachine()->getState();
    }


    public function transition($transition)
    {
        return $this->stateMachine()->apply($transition);
    }

    public function transitionAllowed($transition)
    {
        return $this->stateMachine()->can($transition);
    }

    public function history()
    {
        return $this->hasMany(self::HISTORY_MODEL['name']);
    }

    public function addHistoryLine(array $transitionData)
    {
        $this->save();
        
        $transitionData['user_id'] = auth()->id();
    
        return $this->history()->create($transitionData);
    }
}