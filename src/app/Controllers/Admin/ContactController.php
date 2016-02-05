<?php

namespace Mc388\SimpleCms\App\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mc388\SimpleCms\App\Models\Contact;
use Mc388\SimpleCms\App\Requests\Admin\ContactRequest;

/**
 * Class ContactController
 *
 * @package Mc388\SimpleCms\App\Controllers\Admin
 */
class ContactController extends Controller
{
    /**
     * @var array
     */
    protected $fields = [
        'name' => '',
        'street' => '',
        'postal_code' => '',
        'city' => '',
        'phone' => '',
        'mobile' => '',
        'fax' => '',
        'email' => '',
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
        $contact = Contact::firstOrCreate([]);

        return view('simple-cms::admin.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactRequest|Request $request
     *
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function update(ContactRequest $request)
    {
        $contact = Contact::firstOrCreate([]);

        foreach (array_keys(array_except($this->fields, ['contact'])) as $field) {
            $contact->$field = $request->get($field);
        }
        $contact->save();

        return redirect(route('manage.contacts.edit', array('id' => $contact->id)))
            ->with('message', 'Changes saved.');
    }
}
