<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {

        $per_page = request()->has('per_page') ? request()->get('per_page') : 10;
        $users = User::where('role', 'user')->withTrashed()->paginate($per_page);
        return view('admin.users.index')->with('users', $users);
    }

    public function search(Request $request)
    {
        $term = $request->term;
        $users = User::where("email", "LIKE", '%' . $term . "%")
            ->Orwhere('name', "LIKE", "%" . $term . "%")
            ->get();
        foreach ($users as $key => $user) {
            if ($user->role == "admin") {
                $users->pull($key);
            }
        }
        $users = $users->values()->all();
        $output = "";
        if (count($users) > 0) {
            foreach ($users as $user) {
                $token = csrf_token();
                $route = route('admin.user.destroy', $user);
                $output .= "<tr>";
                $output .= "<td>" . $user->id . "</td>";
                $output .= "<td><b>$user->name</b></td>";
                $output .= "<td>$user->email</td>";
                $output .= <<<_END
    <td>
    <form action="$route" method="POST" onsubmit="return confirm('Are you sure want to delete this user?')">
    <input type="hidden" name="_token" value="$token" />
    <input type="hidden" name="_method" value="DELETE" />
                <button type="submit" class="btn btn-danger hvr-shadow btn-sm">
                    <i class="far fa-trash-alt"></i> Delete
                </button>
    </form>
    </td></tr>
_END;
            }
        }

        if ($output == "") {
            return response()->json(['message' => "Not found"], 404);
        }
        return response($output);
    }

    public function restore(Request $request)
    {
        $user = User::withTrashed()
            ->where('id', $request->id)
            ->restore();
    }

    public function destroy(User $user)
    {
        if ($user->role == 'teacher') {
            $teacher = Teacher::where("user_id", $user->id)->first();
            $teacher->status = 0;
            $teacher->update();
        }
        $user->delete();
        flash("User deleted successfully")->error();
        return redirect()->route('admin.user.index');
    }
}
