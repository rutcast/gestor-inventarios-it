<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Mail\SendClientLoginDetail;
use App\Project\Client;
use App\Project\ClientProject;
use App\Project\ClientWorkspace;
use App\Project\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clientLogout(Request $request)
    {
        \Auth::guard('client')->logout();

        $request->session()->invalidate();

        return redirect()->route('client.login');
    }

    public function index($slug)
    {
        $this->middleware('auth');
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $clients = Client::join('client_workspaces', 'client_workspaces.client_id', '=', 'clients.id')->where('client_workspaces.workspace_id', '=', $currantWorkspace->id)->get();

        return view('project.clients.index', compact('currantWorkspace', 'clients'));
    }

    public function create($slug)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);

        return view('project.project.clients.create', compact('currantWorkspace'));
    }

    public function store($slug, Request $request)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);

        $registerClient = Client::where('email', '=', $request->email)->first();
        if (!$registerClient) {
            $arrUser['name'] = $request->name;
            $arrUser['email'] = $request->email;
            $arrUser['password'] = Hash::make($request->password);
            $registerClient = Client::create($arrUser);

            try {
                $registerClient->password = $request->password;
                Mail::to($request->email)->send(new SendClientLoginDetail($registerClient));
            } catch (\Exception $e) {
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            }
        }
        $checkClient = ClientWorkspace::where('client_id', '=', $registerClient->id)->where('workspace_id', '=', $currantWorkspace->id)->first();
        if (!$checkClient) {
            ClientWorkspace::create(
                [
                    'client_id'    => $registerClient->id,
                    'workspace_id' => $currantWorkspace->id,
                ]
            );
        }

        return redirect()->route('project.clients.index', $currantWorkspace->slug)->with('success', __('Client Created Successfully!'));
    }

    public function edit($slug, $id)
    {
        $client = Client::find($id);
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);

        return view('project.project.clients.edit', compact('client', 'currantWorkspace'));
    }

    public function update($slug, $id, Request $request)
    {
        $client = Client::find($id);
        if ($client) {
            $currantWorkspace = Utility::getWorkspaceBySlug($slug);
            $client->name = $request->name;
            if ($request->password) {
                $client->password = Hash::make($request->password);
            }
            $client->save();

            return redirect()->route('project.clients.index', $currantWorkspace->slug)->with('success', __('Client Updated Successfully!'));
        } else {
            return redirect()->back()->with('error', __('Something is wrong.'));
        }
    }

    public function destroy($slug, $id)
    {
        $client = Client::find($id);
        if ($client) {
            $currantWorkspace = Utility::getWorkspaceBySlug($slug);
            ClientWorkspace::where('client_id', '=', $client->id)->delete();
            ClientProject::where('client_id', '=', $client->id)->delete();
            $client->delete();

            return redirect()->route('project.clients.index', $currantWorkspace->slug)->with('success', __('Client Deleted Successfully!'));
        } else {
            return redirect()->back()->with('error', __('Something is wrong.'));
        }
    }
}
