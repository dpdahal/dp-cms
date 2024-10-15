<?php

namespace App\Repositories\Address;


use App\Models\Address\Continents;
use App\Models\Address\Country;
use App\Traits\General;
use Illuminate\Support\Facades\Request;

class CountryRepository implements CountryInterface
{
    use General;

    private $country;
    private $continents;

    public function __construct(Country $country, Continents $continents)
    {
        $this->country = $country;
        $this->continents = $continents;

    }

    public function all()
    {
        try {
            return $this->country->all();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function find($id)
    {
        try {
            return $this->country->find($id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function updateFile($id, $data)
    {
        return $this->country->findOrFail($id)->update($data);
    }

    public function create($data)
    {
        try {
            $lastInsertId = $this->country->create($data);
            $tableName = $this->country->getTable();
            $filePath = 'uploads/' . $tableName;
            $fileData['image'] = $this->customFileUpload($filePath);
            if ($lastInsertId) {
                $id = $lastInsertId->id;
                $this->updateFile($id, $fileData);
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function update($data, $id)
    {
        try {
            return $this->country->findOrFail($id)->update($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        $http_s = "";

        if (Request::isSecure()) {
            $http_s .= 'https:';
        } else {
            $http_s .= 'http:';
        }

        $post = $this->country->findOrFail($id);

        $descriptionImage = $post->description;
        $arrayDescription = explode('src="', $descriptionImage);
        $imageUrlsDescription = [];
        foreach ($arrayDescription as $item) {
            preg_match('/' . $http_s . '\/\/[^"\']+/', $item, $matches);
            if (!empty($matches[0])) {
                $imageUrlsDescription[] = $matches[0];
            }
        }
        foreach ($imageUrlsDescription as $item) {
            $imagePath = parse_url($item, PHP_URL_PATH);
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
        }

        $realPath = $post->image;
        $filePath = public_path($realPath);
        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
        }


        if ($post->delete()) {
            return true;
        } else {
            return false;
        }

    }

    public function getAllContinent($id = "")
    {
        try {
            return $this->continents->all();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}
