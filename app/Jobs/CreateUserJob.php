<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $name;
    private $username;
    private $fonction;
    private $email;
    private $bio;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        $name,
        $username,
        $fonction,
        $email,
        $bio,
    )
    {
        //
        $this->name = $name;
        $this->username = $username;
        $this->fonction = $fonction;
        $this->email = $email;
        $this->bio = $bio;
    }

    public static function fromRequest(CreateUserRequest $request):self{
        return new static(
            $request->name(),
            $request->username(),
            $request->fonction(),
            $request->email(),
            $request->bio()
        );
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle():User
    {
        //
        
        $user = new User([
            'name' => $this->name,
            'username' => $this->username,
            'slug' => Str::slug($this->username),
            'fonction' => $this->fonction,
            'email' => $this->email,
            'bio' => $this->bio,
            'password' => bcrypt('mekowa')
        ]);
        
        $user->save();

        return $user;
    }
}
