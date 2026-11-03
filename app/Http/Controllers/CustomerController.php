<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.form', [
            'customer' => new Customer(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateCustomer($request);

        if ($request->hasFile('cv')) {
            $data['cv_path'] = $request->file('cv')
                ->store('cvs', 'public');
        }

        Customer::create($data);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.form', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $this->validateCustomer($request, $customer);

        if ($request->hasFile('cv')) {
            if ($customer->cv_path) {
                Storage::disk('public')->delete($customer->cv_path);
            }

            $data['cv_path'] = $request->file('cv')
                ->store('cvs', 'public');
        }

        $customer->update($data);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->cv_path) {
            Storage::disk('public')->delete($customer->cv_path);
        }

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }

    private function validateCustomer(
        Request $request,
        ?Customer $customer = null
    ): array {
        return $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'birthday' => ['nullable', 'date', 'before_or_equal:today'],
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('customers', 'email')
                    ->ignore($customer?->id),
            ],
            'phone' => ['required', 'string', 'max:30'],
            'cv' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
            ],
        ]);
    }

    public function generateCv(Customer $customer)
    {
        $pdf = Pdf::loadView('customers.cv', [
            'customer' => $customer,
        ]);

        $filename = 'CV-' .
            preg_replace(
                '/[^A-Za-z0-9_-]/',
                '-',
                $customer->first_name . '-' . $customer->last_name
            ) . '.pdf';

        return $pdf->download($filename);
    }

    public function downloadCv(Customer $customer)
    {
        abort_unless(
            $customer->cv_path &&
            Storage::disk('public')->exists($customer->cv_path),
            404,
            'File CV tidak ditemukan.'
        );

        return Storage::disk('public')->download(
            $customer->cv_path
        );
    }
}
