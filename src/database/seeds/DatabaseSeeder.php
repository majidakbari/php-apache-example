<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * @var \App\Repositories\Interfaces\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var \App\Repositories\Interfaces\GroupRepositoryInterface
     */
    private $groupRepository;

    /**
     * @var \App\Repositories\Interfaces\AssetRepositoryInterface
     */
    private $assetRepository;

    /**
     * @var \App\Repositories\Interfaces\RoleRepositoryInterface
     */
    private $roleRepository;


    /**
     * DatabaseSeeder constructor.
     * @param \App\Repositories\Interfaces\UserRepositoryInterface $userRepository
     * @param \App\Repositories\Interfaces\GroupRepositoryInterface $groupRepository
     * @param \App\Repositories\Interfaces\AssetRepositoryInterface $assetRepository
     * @param \App\Repositories\Interfaces\RoleRepositoryInterface $roleRepository
     */
    public function __construct(
        \App\Repositories\Interfaces\UserRepositoryInterface $userRepository,
        \App\Repositories\Interfaces\GroupRepositoryInterface $groupRepository,
        \App\Repositories\Interfaces\AssetRepositoryInterface $assetRepository,
        \App\Repositories\Interfaces\RoleRepositoryInterface $roleRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->assetRepository = $assetRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $roles = $this->insertFakeRoles();
        $assets = $this->insertFakeAssets();
        $users = $this->insertFakeUsers();
        $groups = $this->insertFakeGroups();

        $this->attachRolesToUsers($roles, $users);
        $this->attachGroupsToUsers($groups, $users);
        $this->attachGroupsToAssets($groups, $assets);
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    private function insertFakeRoles(): \Illuminate\Support\Collection
    {
        $result = [];

        $roles = [
            ['name' => \App\Entities\Role::ROLE_ADMIN],
            ['name' => \App\Entities\Role::ROLE_NORMAL],
        ];

        foreach ($roles as $role) {
            $result[] = $this->roleRepository->store(new \App\Entities\Role($role));
        }

        return collect($result);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function insertFakeUsers(): \Illuminate\Support\Collection
    {
        $result = [];

        $users = [
            ['first_name' => 'Majid', 'last_name' => 'Akbari'],
            ['first_name' => 'Anne', 'last_name' => 'Seebach'],
        ];

        foreach ($users as $user) {
            $result[] = $this->userRepository->store(new \App\Entities\User($user));
        }

        return collect($result);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function insertFakeGroups(): \Illuminate\Support\Collection
    {
        $result = [];

        $groups = [
            ['name' => 'Group A'],
            ['name' => 'Group B'],
            ['name' => 'Group C'],
            ['name' => 'Group D'],
            ['name' => 'Group E'],
        ];

        foreach ($groups as $group) {
            $result[] = $this->groupRepository->store(new \App\Entities\Group($group));
        }

        return collect($result);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function insertFakeAssets(): \Illuminate\Support\Collection
    {
        $result = [];
        $assets = [];
        for ($i = 0; $i < 100; $i++) {
            $assets[] =  ['name' => "Building $i"];
        }

        foreach ($assets as $asset) {
            $result[] = $this->assetRepository->store(new \App\Entities\Asset($asset));
        }

        return collect($result);
    }

    /**
     * @param \Illuminate\Support\Collection $roles
     * @param \Illuminate\Support\Collection $users
     */
    private function attachRolesToUsers(\Illuminate\Support\Collection $roles, \Illuminate\Support\Collection $users): void
    {
        /** @var \App\Entities\User $user */
        foreach ($users as $key => $user) {
            if ($key === 0) {
                $role = $roles->first();
            } else {
                $role = $roles->last();
            }
            $this->userRepository->attachRole($user, $role);
        }
    }

    /**
     * @param \Illuminate\Support\Collection $groups
     * @param \Illuminate\Support\Collection $users
     */
    private function attachGroupsToUsers(\Illuminate\Support\Collection $groups, \Illuminate\Support\Collection $users): void
    {
        /** @var \App\Entities\User $user */
        foreach ($users as $user) {
            $this->userRepository->attachGroups(
                $user,
                $groups->random(rand(1, $groups->count()))->pluck('id')->toArray()
            );
        }
    }

    /**
     * @param \Illuminate\Support\Collection $groups
     * @param \Illuminate\Support\Collection $assets
     */
    private function attachGroupsToAssets(\Illuminate\Support\Collection $groups, \Illuminate\Support\Collection $assets): void
    {
        /** @var \App\Entities\Asset $asset */
        foreach ($assets as $asset) {
            $this->assetRepository->attachGroups(
                $asset,
                $groups->random(rand(1, $groups->count()))->pluck('id')->toArray()
            );
        }
    }
}
