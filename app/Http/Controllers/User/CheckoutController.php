<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Checkout\Store;
use App\Models\Camp;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Checkout\AfterCheckout;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Store $request, Camp $camp)
    {
        //mapping request data
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['camp_id'] = $camp->id;

        //update user data
        $user = Auth::user();
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->occupation = $data['occupation'];
        $user->save();

        //create checkout
        $checkout = Checkout::create($data);

        // sending email
        Mail::to(Auth::user()->email)->send(new AfterCheckout($checkout));

        return redirect(route('checkout.success'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Camp $camp, Request $request)
    {
        if ($camp->isRegistered) {
            $request->session()->flash("error", "You already registered on {$camp->title} camp");
            return redirect(route('user.dashboard'));
        }
        return view('checkout.create', [
            'camp' => $camp
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Checkout $checkout
     * @return Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Checkout $checkout
     * @return Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Checkout $checkout
     * @return Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Checkout $checkout
     * @return Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }

    public function success()
    {
        return view('checkout.success');
    }
}
