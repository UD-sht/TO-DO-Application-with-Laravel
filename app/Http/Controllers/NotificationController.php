<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Cookie\CookieJar;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    protected $notifications;

    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct() {}

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($request->ajax()) {
            return response()->json([
                'unreadNotificationCount' => $user->unreadNotifications->count(),
                'notifications' => $user->notifications,
            ], 200);
        }

        return view('notifications.index')
            ->with([
                'notifications' => $user->notifications()->whereDate('created_at', '>', now()->subDays(8))->get(),
            ]);
    }

    public function show(Request $request, $id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->find($id);
        // $jsonData = json_decode($notification->data);
        $jsonData = $notification->data;
        $route = $alternateRoute = $jsonData['link'];
        // if (property_exists($jsonData, 'alternate_link')) {
        if (array_key_exists('alternate_link', $jsonData)) {
            $alternateRoute = $jsonData['alternate_link'];
        }
        $notification->markAsRead();

        try {
            $name = Session::getName();
            $sessionId = $_COOKIE[$name];

            $cookieJar = CookieJar::fromArray([
                $name => $sessionId,
            ], env('APP_DOMAIN', 'sbl.test'));

            $client = new Client([
                'headers' => [
                    'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36',
                    'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'],
            ]);
            $client->request('GET', $route, ['cookies' => $cookieJar]);

            return redirect($route);
        } catch (\GuzzleHttp\Exception\ClientException $ex) {
            return redirect($alternateRoute);
        }
    }
}
