<?php

namespace App\Http\Controllers\Asset;


use App\Entities\Role;
use App\Entities\User;
use App\Repositories\Interfaces\AssetRepositoryInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ListAssetsAction
 * @package App\Http\Controllers\Asset
 */
class ListAssetsAction
{
    /**
     * @var AssetRepositoryInterface
     */
    private $assetRepository;
    /**
     * @var AuthRepositoryInterface
     */
    private $authRepository;

    /**
     * ListAssetsAction constructor.
     * @param AssetRepositoryInterface $assetRepository
     * @param AuthRepositoryInterface $authRepository
     */
    public function __construct(
        AssetRepositoryInterface $assetRepository,
        AuthRepositoryInterface $authRepository
    )
    {
        $this->assetRepository = $assetRepository;
        $this->authRepository = $authRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request) :JsonResponse
    {
        $result = $this->assetRepository->findManyByCriteria(
            $this->getCriteria(),
            get_paginate_params($request)
        );

        return response()->json($result);
    }


    /**
     * Because I did not handle the authentication and can not retrieve the logged in user, this function will randomly
     * returns a user who has Normal or Admin role
     * @return User
     */
    private function getLoggedInUser(): ?User
    {
        return $this->authRepository->user();
    }


    /**
     * @return array
     */
    private function getCriteria(): array
    {
        $user = $this->getLoggedInUser();
        $isAdmin = false;

        /** @var Role $role */
        foreach ($user->roles as $role) {
            if ($role->name == Role::ROLE_ADMIN) {
                $isAdmin = true;
            }
        }

        return ['is_admin' => $isAdmin, 'user_id' => $user->id];
    }
}
