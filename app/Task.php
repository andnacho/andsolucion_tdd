<?php

namespace App;

use App\Project;
use App\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Task extends Model
{
    use RecordsActivity;

    /**
     * Attributes to guard against mass assignment
     * @var array
     */
    protected $guarded = [];

    protected $touches = ['project'];


    protected $casts = [
        'completed' => 'boolean'
    ];

    protected static $recordableEvents = ['created', 'deleted'];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function complete()
    {
        $this->update(['completed' => true]);
        $this->recordActivity('completed_task');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->recordActivity('incompleted_task');
    }

//
//Este metodo se envió al trait
//   /**
//     * @return array
//     */
//    public function activityChanges()
//    {
//
//        if($this->wasChanged()){
//            return [
//                'before' => array_except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
//                'after' => array_except($this->getChanges(), 'updated_at')
//            ];
//        }
//
//    }/

}
