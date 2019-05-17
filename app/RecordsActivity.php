<?php


namespace App;


use Illuminate\Support\Arr;

trait RecordsActivity
{


    public $oldAttributes = [];

    /**
     * Boot the trait.
     */
    public static function bootRecordsActivity()
    {

        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {

                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function ($model) {
                    $model->oldAttributes = $model->getOriginal();
                });
            }

        }
    }

    protected function activityDescription($description)
    {
        return "{$description}_" . strtolower(class_basename($this)); //created_task
    }

    /**
     * @return array|mixed
     */
    public static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return $recordableEvents = static::$recordableEvents;
        }
        return $recordableEvents = ['created', 'updated'];

    }

    /**
     * Record activity for a project
     *
     * @param $description
     * @param $project
     */
    public function recordActivity($description)
    {
        $this->activity()->create([
            'user_id'     => ($this->project ?? $this)->owner->id, //Antes ActivityOwner
            'description' => $description,
            'changes'     => $this->activityChanges(),
            'project_id'  => class_basename($this) === 'Project' ? $this->id : $this->project_id
        ]);

    }

    protected function activityOwner()
    {
//                if(auth()->check()){
//            return auth()->user();
//        }
//        if(class_basename($this) === 'Project'){
//            return $this->owner;
//        }

//        return;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    public function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after'  => Arr::except($this->getChanges(), 'updated_at')
            ];
        }

    }
}