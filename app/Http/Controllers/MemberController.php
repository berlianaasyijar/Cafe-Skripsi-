<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    // Other CRUD methods
    public function index()
    {
        $members = Member::where('status', 1)->get();
        return view('member/member-data', compact('members'));
    }

    public function create()
    {
        return view('member.member-tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|unique:members',
            'no_hp' => 'required|string',
            'point' => 'required|integer',
        ]);

        Member::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'point' => $request->point,
            'level' => 'Bronze', // Default level
            'creaby' => 'Admin', // You can change this to the current user's name if available
            'creadate' => now(),
        ]);

        return redirect()->route('member.index')->with('success', 'Member created successfully.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->status = 0;
        $member->save();

        return redirect()->route('member.index')->with('success', 'Member deleted successfully.');
    }
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('member-edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'point' => 'required|integer',
        ]);

        $member = Member::findOrFail($id);
        $member->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'point' => $request->point,
            'updated_by' => auth()->user()->id, // Assuming you have user authentication
            'updated_date' => now(),
        ]);

        return redirect()->route('member.index')->with('success', 'Member updated successfully.');
    }
}
