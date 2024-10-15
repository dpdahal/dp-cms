<?php

namespace App\Repositories\Profile;

interface UserProfileInterface
{

    public function get_profile();


    public function updateCustomPassword($data);

    public function update($data, $id);


    public function getCountry();


    public function getSkills();


    public function getEducation();
}
