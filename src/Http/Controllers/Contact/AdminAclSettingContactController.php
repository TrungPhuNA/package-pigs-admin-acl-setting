<?php

namespace Pigs\AdminAclSetting\Http\Controllers\Contact;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Pigs\AdminAclSetting\Models\AdmAclContact;

class AdminAclSettingContactController extends Controller
{
    public function index(Request $request)
    {
        try {
            $contacts = AdmAclContact::orderByDesc('id')->paginate(20);

            $viewData = [
                'contacts' => $contacts,
                "query"    => $request->query()
            ];

            return view('adm_acl_setting::pages.contact.index', $viewData);
        } catch (\Exception $exception) {
            Log::error("[AdminAclSettingContactController][index] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $contact = AdmAclContact::findOrFail($id);
            if ($contact) {
                $contact->delete();
            }

        } catch (\Exception $exception) {
            Log::error("ERROR => AdminAclSettingContactController@delete => ".$exception->getMessage());
        }
        return redirect()->route('get.adm_acl_setting.contact.index');
    }
}
