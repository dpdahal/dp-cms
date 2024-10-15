<?php

namespace App\Http\Controllers\Backend\Address;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Address\CountryCreateRequest;
use App\Repositories\Address\CountryInterface;
use Illuminate\Http\Request;

class CountryController extends BackendController
{
    private CountryInterface $country;

    public function __construct(CountryInterface $country)
    {
        parent::__construct();
        $this->country = $country;
    }

    public function index()
    {
        $this->checkAuthorization(auth()->user(), 'countries_list');
        $countryData = $this->country->all();
        $this->data('countriesData', $countryData);
        return view($this->pagePath . 'address.country.index', $this->data);
    }

    public function create()
    {
        $this->checkAuthorization(auth()->user(), 'countries_create');
        $this->data('continentsData', $this->country->getAllContinent());
        return view($this->pagePath . 'address.country.create', $this->data);
    }

    public function store(CountryCreateRequest $request)
    {
        $this->checkAuthorization(auth()->user(), 'countries_create');
        $this->country->create($request->all());
        return redirect()->route('countries.index')->with('success', 'Country created successfully');
    }

    public function show(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'countries_show');
        $countryData = $this->country->find($id);
        $this->data('countryData', $countryData);
        return view($this->pagePath . 'address.country.show', $this->data);
    }


    public function edit(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'countries_edit');
        $countryData = $this->country->find($id);
        $this->data('countryData', $countryData);
        $this->data('continentsData', $this->country->getAllContinent($id));
        return view($this->pagePath . 'address.country.edit', $this->data);
    }

    public function update(Request $request, string $id)
    {

        $this->checkAuthorization(auth()->user(), 'countries_edit');
        $request->validate([
            'country_name' => 'required|unique:countries,country_name,' . $id,
            'code' => 'required',
            'continent_id' => 'required',
        ]);
        $this->country->update($request->all(), $id);
        return redirect()->route('countries.index')->with('success', 'Country updated successfully');
    }


    public function destroy(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'countries_delete');
        $this->country->delete($id);
        return redirect()->route('countries.index')->with('success', 'Country deleted successfully');
    }
}
