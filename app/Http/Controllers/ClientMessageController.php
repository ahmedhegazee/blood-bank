<?php

namespace App\Http\Controllers;

use App\Models\ClientMessage;
use Illuminate\Http\Request;

class ClientMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = ClientMessage::with('client')->search($request->search)->paginate(10);
        return view('client-messages.index', compact('records'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientMessage $message)
    {
        $message->delete();
        flash('Message is deleted', 'success')->important();
        return redirect(route('message.index'));
    }
}
