<?php
 
namespace App\Http\Controllers;
 
use App\Models\SportType;
use Illuminate\Http\Request;
 
class SportTypeController extends Controller
{
    public function index()
    {
        $sportTypes = SportType::withCount('events')->get();
        return view('admin.sport_types.index', compact('sportTypes'));
    }
 
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:sport_types,name',
        ]);
 
        SportType::create($data);
 
        return back()->with('success', 'Catégorie de sport créée avec succès.');
    }
 
    public function update(Request $request, SportType $sportType)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:sport_types,name,' . $sportType->id,
        ]);
 
        $sportType->update($data);
 
        return back()->with('success', 'Catégorie de sport mise à jour avec succès.');
    }
 
    public function destroy(SportType $sportType)
    {
        if ($sportType->events()->exists()) {
            return back()->with('error', 'Impossible de supprimer cette catégorie car elle contient des événements actifs.');
        }
 
        $sportType->delete();
 
        return back()->with('success', 'Catégorie de sport supprimée avec succès.');
    }
}
