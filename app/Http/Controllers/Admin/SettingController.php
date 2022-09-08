<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateSettingRequest;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Repositories\Admin\SettingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use Response;
use function Couchbase\defaultDecoder;

class SettingController extends AppBaseController
{
    /** @var SettingRepository $settingRepository*/
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Display a listing of the Setting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $settings = $this->settingRepository->paginate(10);

        return view('admin.settings.index')
            ->with('settings', $settings);
    }

    /**
     * Show the form for creating a new Setting.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created Setting in storage.
     *
     * @param CreateSettingRequest $request
     *
     * @return Response
     */
    public function store(CreateSettingRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile("app_logo")) {
            $img = $request->file("app_logo");
            $img->store('public/setting');
            $input['app_logo'] = $img->hashName();
        }
        $setting = $this->settingRepository->create($input);

        Flash::success('Setting saved successfully.');

        return redirect(route('admin.settings.index'));
    }

    /**
     * Display the specified Setting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('admin.settings.index'));
        }

        return view('admin.settings.show')->with('setting', $setting);
    }

    /**
     * Show the form for editing the specified Setting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('admin.settings.index'));
        }

        return view('admin.settings.edit')->with('setting', $setting);
    }

    /**
     * Update the specified Setting in storage.
     *
     * @param int $id
     * @param UpdateSettingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSettingRequest $request)
    {
        $setting = $this->settingRepository->find($id);
       $input = $request->all();
        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('admin.settings.index'));
        }
        if ($request->hasFile("app_logo")) {
            $img = $request->file("app_logo");
            if (Storage::exists('/public/setting/' . $setting->app_logo)) {
                Storage::delete('/public/setting/' . $setting->app_logo);
            }
            $img->store('public/setting');
            $input['app_logo'] = $img->hashName();
        }
        $setting = $this->settingRepository->update($input, $id);

        Flash::success('Setting updated successfully.');

        return redirect(route('admin.settings.index'));
    }

    /**
     * Remove the specified Setting from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('admin.settings.index'));
        }

        $this->settingRepository->delete($id);

        Flash::success('Setting deleted successfully.');

        return redirect(route('admin.settings.index'));
    }


}
