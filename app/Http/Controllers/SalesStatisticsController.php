<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\SalesStatistics;
use Illuminate\Http\Request;

class SalesStatisticsController extends Controller
{
    public function index()
    {
        $salesStatistics = SalesStatistics::with('client')->get();

        return view('#', compact('salesStatistics')); // a rediriger
    }

    public function create()
    {
        $clients = Client::all();

        return view('#', compact('clients')); // a rediriger
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'sales_count' => 'nullable|integer|min:1',
            'date' => 'required|date',
        ]);

        if (!isset($validated['sales_count'])) {
            $validated['sales_count'] = 1;
        }

        SalesStatistics::create($validated);

        return redirect()->route('#'); // a rediriger
    }

    public function show(string $id)
    {
        $salesStatistic = SalesStatistics::with('client')->findOrFail($id);

        return view('#', compact('salesStatistic')); // a rediriger
    }

    public function edit(string $id)
    {
        $salesStatistic = SalesStatistics::findOrFail($id);
        $clients = Client::all();

        return view('#', compact('salesStatistic', 'clients')); // a rediriger
    }

    public function update(Request $request, string $id)
    {
        $salesStatistic = SalesStatistics::findOrFail($id);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'sales_count' => 'nullable|integer|min:1',
            'date' => 'required|date',
        ]);

        if (!isset($validated['sales_count'])) {
            $validated['sales_count'] = 1;
        }

        $salesStatistic->update($validated);

        return redirect()->route('#'); // a rediriger
    }

    public function destroy(string $id)
    {
        $salesStatistic = SalesStatistics::findOrFail($id);

        $salesStatistic->delete();

        return redirect()->route('#'); // a rediriger
    }
}
