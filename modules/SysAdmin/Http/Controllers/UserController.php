<?php

namespace Modules\SysAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    public function index()
    {
        return inertia('user/Index');
    }

    public function detail($id = 0)
    {
        return inertia('user/Detail', [
            'data' => User::findOrFail($id),
        ]);
    }

    public function data(Request $request)
    {
        $orderBy = $request->get('order_by', 'name');
        $orderType = $request->get('order_type', 'asc');
        $filter = $request->get('filter', []);

        $q = User::with([]);
        $q->orderBy($orderBy, $orderType);

        if (!empty($filter['status']) && ($filter['status'] == 'active' || $filter['status'] == 'inactive')) {
            $q->where('active', '=', $filter['status'] == 'active' ? true : false);
        }

        if (!empty($filter['search'])) {
            $q->where(function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter['search'] . '%')
                    ->orWhere('username', 'like', '%' . $filter['search'] . '%');
            });
        }

        $users = $q->paginate($request->get('per_page', 10))->withQueryString();

        return response()->json($users);
    }

    public function duplicate($id)
    {
        $user = User::findOrFail($id);
        $user->id = null;
        $user->created_at = null;
        return inertia('user/Editor', [
            'data' => $user
        ]);
    }

    public function editor($id = 0)
    {
        $user = $id ? User::findOrFail($id) : new User();

        if (!$id) {
            $user->active = true;
            $user->admin = true;
        } else if ($user == Auth::user()) {
            return redirect(route('sys-admin.user.index'))
                ->with('warning', 'TIdak dapat mengubah akun anda sendiri.');
        }

        return inertia('user/Editor', [
            'data' => $user,
        ]);
    }

    public function save(Request $request)
    {
        $isCreate = !$request->id;

        $rules = [
            'name'     => 'required|max:255',
            'username' => [
                'required',
                'alpha_num',
                'max:255',
                Rule::unique('users', 'username')->ignore($request->id)
            ],
            'active'   => 'required|boolean',
        ];

        if ($isCreate || $request->filled('password')) {
            $rules['password'] = 'required|min:5|max:40';
        }

        $validated = $request->validate($rules);
        $user = $isCreate ? new User() : User::findOrFail($request->id);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->fill($validated)->save();

        $message = "Pengguna {$user->username} telah " . ($isCreate ? 'ditambahkan' : 'diperbarui') . '.';

        return redirect(route('sys-admin.user.index'))
            ->with('success', $message);
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == Auth::user()->id) {
            return response()->json([
                'message' => 'Tidak dapat menghapus akun sendiri!'
            ], 409);
        }

        $user->delete();

        return response()->json([
            'message' => "Pengguna {$user->username} telah dihapus!"
        ]);
    }
}
