<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function getPayment(Request $request)
    {
        $userId = $request->get('user_id');
        $payment = Payment::query()->where('user_id', $userId)->get();
        return view('site.payment-method')->with(['payments' => $payment]);
    }

    public function addPaymentMethod(Request $request)
    {
        try {
            $data = $request->all();
            $payment = new Payment();
            $type = $data['type'] ?? '';
            $payment->type = intval($type);
            if ($type == 1) {
                $request->validate([
                    'phone' => ['required', 'max:255'],
                    'bank_mono_name' => ['required'],
                ]);
                $payment->user_id = $data['user_id'];
                $payment->bank_account = $data['bank_mono_name'];
                $payment->phone = $data['phone'];
                $payment->save();
            } else if ($type == 2) {
                $request->validate([
                'bank_account' => ['required', 'max:255'],
                'bank_name' => ['required'],
                'bank_number' => ['required','numeric']
            ]);
                $payment->user_id = $data['user_id'];
                $payment->bank_account = $data['bank_account'];
                $payment->bank_name = $data['bank_name'];
                $payment->bank_number = $data['bank_number'];
                $payment->save();
            }
            return redirect()->route('admin.home.index')->with('success', 'add payment success');
        } catch (\Exception $exception) {
            return redirect()->route('admin.home.index')->with('error', 'add payment fail');
        }

    }

    public function editPaymentMethod(Request $request)
    {
        try {
            $data = $request->all();
            $payment = Payment::query()->where('id', $data['_id'])->first();
            if (empty($payment) ) throw new \Exception('loi');
            $type = $data['type1'] ?? '';
            $active = intval($data['active'] ?? 1);
            $payment->type = intval($type);
            $payment->active = $active;
            if ($type == 1) {
                $request->validate([
                    'phone1' => ['required', 'max:255'],
                    'bank_mono_name1' => ['required'],
                ]);
                $payment->user_id = $data['user_id'];
                $payment->bank_account = $data['bank_mono_name1'];
                $payment->phone = $data['phone1'];
                $payment->save();
            } else if ($type == 2) {
                $request->validate([
                'bank_account1' => ['required', 'max:255'],
                'bank_name1' => ['required'],
                'bank_number1' => ['required','numeric']
            ]);
                $payment->user_id = $data['user_id'];
                $payment->bank_account = $data['bank_account1'];
                $payment->bank_name = $data['bank_name1'];
                $payment->bank_number = $data['bank_number1'];
                $payment->save();
            }
            return redirect()->route('admin.home.index')->with('success', 'add payment success');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->route('admin.home.index')->with('error', 'add payment fail');
        }
    }

    public function delPayment(Request $request)
    {
        try {
            $id = intval($request->get('id') ?? 0);
            Payment::query()->where('id', $id)->delete();
            return response()->json([], 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

}
