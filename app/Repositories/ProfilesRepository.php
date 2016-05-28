<?php

namespace App\Repositories;

use App\Profile;
use App\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProfilesRepository extends BaseRepository
{

    protected function extractData($extracted = [])
    {
        $extracted = [];
        if ($this->request->has('fullname')) {
            $extracted['fullname'] = $this->request->get('fullname');
        }

        if ($this->request->has('bdate')) {
            $extracted['bdate'] = $this->request->get('bdate');
        }

        if ($this->request->has('numphone')) {
            $extracted['numphone'] = $this->request->get('numphone');
        }

        if ($this->request->hasFile('image')) {
            $image_file = $this->request->file('image');
            $image_extension = $image_file->getClientOriginalExtension();
            $extracted['image_filename'] = $image_file->getFilename().'.'.$image_extension;
            $extracted['original_image_filename'] = $image_file->getClientOriginalName();
            $extracted['image_mime'] = $image_file->getClientMimeType();
            Storage::disk('local')->put($image_file->getFilename().'.'.$image_extension,  File::get($image_file));
        }

        return $extracted;
    }

    public function lists()
    {
        $profile = $this->user->profiles();

        if ($fullname = $this->request->get('fullname')) {
            $profile->where('fullname', 'like', "%{$fullname}%");
        }

        if ($bdate = $this->request->get('bdate')) {
            $profile->where('bdate', 'like', "%{$bdate}%");
        }

        if ($numphone = $this->request->get('numphone')) {
            $profile->where('numphone', 'like', "%{$numphone}%");
        }

        return $profile->paginate();
    }

    public function create()
    {
        return $this->user->profiles()->create($this->extractData());
    }

    public function update(Profile $profile)
    {
        $profile->update($this->extractData());
        return $profile;
    }

    public function delete(Profile $profile)
    {
        $profile->delete();
        return $profile;
    }

}
