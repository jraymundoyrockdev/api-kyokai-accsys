<?php

namespace ApiGfccm\Http\Controllers\Api;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;
use ApiGfccm\Http\Controllers\Api\Transformers\UserTransformer;
use ApiGfccm\Http\Requests;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;

class UsersController extends ApiController
{

    /**
     * @var UserRepositoryInterface
     */
    protected $user;

    /**
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     *  Get all Users
     */
    public function index()
    {
        return $this->user->getAllUsers();
    }

    /**
     *  Get specific User
     *
     * @param int $id
     *
     * @return Object|null
     */
    public function show($id)
    {
        return $this->user->getById($id);
    }
}