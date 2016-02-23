<?php

namespace Mc388\SimpleCms\App\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mc388\SimpleCms\App\Models\Setting;
use Mc388\SimpleCms\App\Requests\Admin\SettingRequest;

/**
 * Class SettingController
 *
 * @package Mc388\SimpleCms\App\Controllers\Admin
 */
class SettingController extends Controller
{
    /**
     * @var array
     */
    protected $fields = [
        'website_title' => '',
        'google_analytics_id' => '',
    ];

    /**
     * Edit the specified content.
     *
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $settings = Setting::firstOrCreate([]);

        return view('simple-cms::admin.settings.edit', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest $request
     *
     * @return Redirector|RedirectResponse
     */
    public function update(SettingRequest $request)
    {
        $settings = Setting::firstOrCreate([]);

        foreach (array_keys(array_except($this->fields, ['settings'])) as $field) {
            $settings->$field = $request->get($field);
        }
        $settings->save();

        return redirect(route('manage.settings.edit', array('id' => $settings->id)))
            ->with('message', 'Changes saved.');
    }
}
