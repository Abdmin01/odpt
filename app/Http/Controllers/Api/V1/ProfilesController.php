<?php

namespace App\Http\Controllers\Api\V1;

use App\Acls\ProfilesAcl;
use App\Http\Controllers\Controller;
use App\Repositories\ProfilesRepository;
use App\Profile;
use App\Validators\ProfilesValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class ProfilesController extends Controller
{
    //
    public function index()
    {
        return $this->repository->lists();
    }

    public function store()
    {
        return $this->repository->create();
    }

    public function show(Profile $profile)
    {
        return $profile->load('user');
    }

    public function update(Profile $profile)
    {
        return $this->repository->update($profile);
    }

    public function destroy(Profile $profile)
    {
        $this->repository->delete($profile);
    }

    public function __construct(ProfilesRepository $repository, Request $request)
    {
        parent::__construct();
        $this->middleware([
            'acl:' . ProfilesAcl::class,
            'validate:' . ProfilesValidator::class,
        ]);
        $this->repository = $repository;
        $this->request = $request;
    }
}
