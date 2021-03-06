<?php

namespace App;

use App\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected $appends = ['isSubscribedTo'];

    protected static function boot()
    {

        parent::boot();

       

        static::deleting(function ($thread){
            $thread->replies->each->delete();
            });
        }
        

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }



    public function replies()
    {
        return $this->hasMany(Reply::class);
    }



    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function channel(){
        return $this->belongsTo(Channel::class);
    }



    public function addReply($reply)
    {
      $reply = $this->replies()->create($reply);

      // Prepare notifications for all subscribers.

      $this->subscriptions
            ->filter(function ($sub) use ($reply) {
            return $sub->user_id != $reply->user_id;
      })
      ->each->notify($reply);

      return $reply;
    }


  

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }




    // Za subscribe thred-a

    public function subscribe($userId = null) 
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);

        return $this;
    }


    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    public function subscriptions()
    {
       return  $this->hasMany(ThreadSubscription::class);
    }


    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
                    ->where('user_id', auth()->id())
                    ->exists();
    }



}
