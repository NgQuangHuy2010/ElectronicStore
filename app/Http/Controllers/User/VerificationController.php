<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\UnauthorizedException;
class VerificationController extends Controller
{
    public function Verify(Request $request, $id, $hash)
{
    $user = User::findOrFail($id); // Tìm người dùng theo ID trong URL

    // Kiểm tra nếu URL không có chữ ký hợp lệ
    if (! URL::hasValidSignature($request)) {
        abort(403, 'Invalid signature.');
    }

    // Kiểm tra nếu hash trong URL khớp với email người dùng
    if (! hash_equals($hash, sha1($user->email))) {
        abort(403, 'Invalid verification link.');
    }

    // Đánh dấu email là đã xác minh nếu nó chưa được xác minh
    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return redirect()->route('User.Login')->with('statusVerified', 'Email successfully verified!');
}

    public function Resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('User.Home');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Đã gửi lại email xác minh.');
    }
}
